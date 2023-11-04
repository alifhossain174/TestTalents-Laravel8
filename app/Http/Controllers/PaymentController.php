<?php

namespace App\Http\Controllers;

use App\PaymentInfo;
use App\PricingPackage;
use App\Quotation;
use App\RechargeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentRequestReceived;
use Illuminate\Support\Str;
use App\Mail\PaymentRequestApprove;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkoutPackage($package){
        $packageInfo = PricingPackage::where('slug', $package)->first();
        session(['package_name' => $packageInfo->title]);
        return view('backend.checkout', compact('packageInfo'));
    }

    public function seachCountries(Request $request){
    	$data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = DB::table('country')
                        ->where('name','LIKE',"%$search%")
                        ->limit(10)
                        ->get();
        }
        return response()->json($data);
    }

    public function payment(Request $request){

        // storing some data into session for further steps
        session(['limit' => $request->limit]);

        $tran_id = "test".rand(1111111, 9999999);//unique transection id for every transection
        $currency= $request->currency; //aamarPay support Two type of currency USD & BDT
        $amount = $request->amount;   //10 taka is the minimum amount for show card option in aamarPay payment gateway
        //For live Store Id & Signature Key please mail to support@aamarpay.com
        $store_id = "testtalents"; //"aamarpaytest";
        $signature_key = "542e95782ab8382d7b4944b54078ef96"; //"dbb74894e82415a2f7ff0ec3a97e4183";
        $url = "https://secure.aamarpay.com/jsonpost.php"; //"https://sandbox.aamarpay.com/jsonpost.php"; // for Live Transection use "https://secure.aamarpay.com/jsonpost.php"

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "store_id": "'.$store_id.'",
                "tran_id": "'.$tran_id.'",
                "success_url": "'.route('success').'",
                "fail_url": "'.route('fail').'",
                "cancel_url": "'.route('cancel').'",
                "amount": "'.$amount.'",
                "currency": "'.$currency.'",
                "signature_key": "'.$signature_key.'",
                "desc": "Merchant Registration Payment",
                "cus_name": "'.$request->name.'",
                "cus_email": "'.$request->email.'",
                "cus_add1": "'.$request->present_address.'",
                "cus_add2": "'.$request->permenant_address.'",
                "cus_city": "'.$request->city.'",
                "cus_state": "'.$request->state.'",
                "cus_postcode": "'.$request->post_code.'",
                "cus_country": "'.$request->country.'",
                "cus_phone": "'.$request->contact.'",
                "type": "json"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        // dd($response);

        $responseObj = json_decode($response);

        if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {
            $paymentUrl = $responseObj->payment_url;
            // dd($paymentUrl);
            return redirect()->away($paymentUrl);
        }else{
            echo $response;
        }

    }

    public function success(Request $request){

        $request_id = $request->mer_txnid;
        //verify the transection using Search Transection API
        $url = "http://secure.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=testtalents&signature_key=542e95782ab8382d7b4944b54078ef96&type=json";
        // $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";
        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        // echo $response->pg_txnid;

        $lastPaymentInsertId = PaymentInfo::insertGetId([
            "pg_txnid" => $response->pg_txnid,
            "mer_txnid" => $response->mer_txnid,
            "risk_title" => $response->risk_title,
            "risk_level" => $response->risk_level,
            "cus_name" => $response->cus_name,
            "cus_email" => $response->cus_email,
            "cus_phone" => $response->cus_phone,
            "desc" => $response->desc,
            "cus_add1" => $response->cus_add1,
            "cus_add2" => $response->cus_add2,
            "cus_city" => $response->cus_city,
            "cus_state" => $response->cus_state,
            "cus_postcode" => $response->cus_postcode,
            "cus_country" => $response->cus_country,
            "cus_fax" => $response->cus_fax,
            "ship_name" => $response->ship_name,
            "ship_add1" => $response->ship_add1,
            "ship_add2" => $response->ship_add2,
            "ship_city" => $response->ship_city,
            "ship_state" => $response->ship_state,
            "ship_postcode" => $response->ship_postcode,
            "ship_country" => $response->ship_country,
            "merchant_id" => $response->merchant_id,
            "store_id" => $response->store_id,
            "amount" => $response->amount,
            "amount_bdt" => $response->amount_bdt,
            "pay_status" => $response->pay_status,
            "status_code" => $response->status_code,
            "status_title" => $response->status_title,
            "cardnumber" => $response->cardnumber,
            "approval_code" => $response->approval_code,
            "payment_processor" => $response->payment_processor,
            "bank_trxid" => $response->bank_trxid,
            "payment_type" => $response->payment_type,
            "error_code" => $response->error_code,
            "error_title" => $response->error_title,
            "bin_country" => $response->bin_country,
            "bin_issuer" => $response->bin_issuer,
            "bin_cardtype" => $response->bin_cardtype,
            "bin_cardcategory" => $response->bin_cardcategory,
            "date" => $response->date,
            "date_processed" => $response->date_processed,
            "amount_currency" => $response->amount_currency,
            "rec_amount" => $response->rec_amount,
            "processing_ratio" => $response->processing_ratio,
            "processing_charge" => $response->processing_charge,
            "ip" => $response->ip,
            "currency" => $response->currency,
            "currency_merchant" => $response->currency_merchant,
            "convertion_rate" => $response->convertion_rate,
            "opt_a" => $response->opt_a,
            "opt_b" => $response->opt_b,
            "opt_c" => $response->opt_c,
            "opt_d" => $response->opt_d,
            "verify_status" => $response->verify_status,
            "call_type" => $response->call_type,
            "email_send" => $response->email_send,
            "doc_recived" => $response->doc_recived,
            "checkout_status" => $response->checkout_status,
        ]);

        // inserting data into recharge history
        $lastInsertId = RechargeHistory::insertGetId([
            'user_id' => Auth::user()->id,
            'payment_id' => $lastPaymentInsertId,
            'recharge_date' => date('Y-m-d'),
            'recharge_amount' => (int) $response->amount,
            'invitation_limit' => session('limit'),
            'agent_no' => $response->payment_processor,
            'user_no' => $response->payment_type,
            'transaction_id' => $response->pg_txnid,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $email = Auth::user()->email;

        $rechargeInfo = DB::table('recharge_histories')
                        ->join('users','users.id','=','recharge_histories.user_id')
                        ->select('recharge_histories.*','users.*')
                        ->where('recharge_histories.id', $lastInsertId)
                        ->first();

        $data = array();
        $data['id'] = $rechargeInfo->id;
        $data['user_id'] = $rechargeInfo->user_id;
        $data['recharge_date'] = $rechargeInfo->recharge_date;
        $data['recharge_amount'] = $rechargeInfo->recharge_amount;
        $data['agent_no'] = $rechargeInfo->agent_no;
        $data['user_no'] = $rechargeInfo->user_no;
        $data['transaction_id'] = $rechargeInfo->transaction_id;
        $data['created_at'] = $rechargeInfo->created_at;
        $data['name'] = $rechargeInfo->name;
        $data['current_limit'] = $rechargeInfo->current_limit;
        $data['expire_date'] = $rechargeInfo->expire_date;
        $data['package_name'] = session('package_name');

        // Mail::to(trim($email))->send(new PaymentRequestReceived($data));

        // approved payment in recharge hisotry
        $userInfo = User::where('id', Auth::user()->id)->first();
        $userInfo->current_limit = $userInfo->current_limit + session('limit');
        $userInfo->expire_date = date('Y-m-d', strtotime(date("Y-m-d"). ' + 1 years'));
        $userInfo->updated_at = Carbon::now();
        $userInfo->save();

        RechargeHistory::where('id', $lastInsertId)->update([
            'status' => 1,
            'updated_at' => Carbon::now()
        ]);

        $rechargeInfo = DB::table('recharge_histories')
                        ->join('users','users.id','=','recharge_histories.user_id')
                        ->select('recharge_histories.*','users.*')
                        ->where('recharge_histories.id', $lastInsertId)
                        ->first();

        $data = array();
        $data['id'] = $rechargeInfo->id;
        $data['user_id'] = $rechargeInfo->user_id;
        $data['recharge_date'] = $rechargeInfo->recharge_date;
        $data['recharge_amount'] = $rechargeInfo->recharge_amount;
        $data['agent_no'] = $rechargeInfo->agent_no;
        $data['user_no'] = $rechargeInfo->user_no;
        $data['transaction_id'] = $rechargeInfo->transaction_id;
        $data['created_at'] = $rechargeInfo->created_at;
        $data['name'] = $rechargeInfo->name;
        $data['current_limit'] = $rechargeInfo->current_limit;
        $data['expire_date'] = $rechargeInfo->expire_date;
        $data['package_name'] = session('package_name');

        // Mail::to(trim($email))->send(new PaymentRequestApprove($data));

        Toastr::success('Payment Completed', 'Successfully');
        return redirect('plan/billing');


        // response format
        // {
        //     "pg_txnid":"AAM1692813664103949",
        //     "mer_txnid":"test8790073",
        //     "risk_title":"Safe",
        //     "risk_level":"0",
        //     "cus_name":"Name",
        //     "cus_email":"payer@merchantcusomter.com",
        //     "cus_phone":"+8801704",
        //     "desc":"Merchant Registration Payment",
        //     "cus_add1":"House B-158 Road 22",
        //     "cus_add2":"Mohakhali DOHS",
        //     "cus_city":"Dhaka",
        //     "cus_state":null,
        //     "cus_postcode":null,
        //     "cus_country":"Bangladesh",
        //     "cus_fax":null,
        //     "ship_name":null,
        //     "ship_add1":null,
        //     "ship_add2":null,
        //     "ship_city":null,
        //     "ship_state":null,
        //     "ship_postcode":null,
        //     "ship_country":null,
        //     "merchant_id":"aamarpaytest",
        //     "store_id":"aamarpaytest",
        //     "amount":"10.00",
        //     "amount_bdt":"10.00",
        //     "pay_status":"Successful",
        //     "status_code":"2",
        //     "status_title":"Successful Transaction",
        //     "cardnumber":"1234XXXXXXXXX123",
        //     "approval_code":"1036053197407",
        //     "payment_processor":"DBBL",
        //     "bank_trxid":"1036053197407",
        //     "payment_type":"DBBL-VISA",
        //     "error_code":"No",
        //     "error_title":"Not Available",
        //     "bin_country":"Not Available",
        //     "bin_issuer":"Not Available",
        //     "bin_cardtype":"Not Available",
        //     "bin_cardcategory":"Not Available",
        //     "date":"2023-08-24 0:01:04",
        //     "date_processed":"2023-08-24 0:01:04",
        //     "amount_currency":"10.00",
        //     "rec_amount":"9.67",
        //     "processing_ratio":"3.25",
        //     "processing_charge":"0.33",
        //     "ip":"103.109.96.129",
        //     "currency":"BDT",
        //     "currency_merchant":"BDT",
        //     "convertion_rate":"Not-Available",
        //     "opt_a":"Not-Available",
        //     "opt_b":"Not-Available",
        //     "opt_c":"Not-Available",
        //     "opt_d":"Not-Available",
        //     "verify_status":"PENDING",
        //     "call_type":"Post-Method",
        //     "email_send":"Not-Available",
        //     "doc_recived":"NO",
        //     "checkout_status":"Not-Paid-Yet"
        // }

    }

    public function fail(Request $request){
        // return $request;
        Toastr::error('Payment Failed', 'Failed');
        return redirect('plan/billing');
    }

    public function cancel(){
        // return 'Canceled';
        Toastr::error('Payment Canceled', 'Canceled');
        return redirect('plan/billing');
    }


    // quotation part
    public function submitQuotation(Request $request){

        $attachment = null;
        if ($request->hasFile('attachment')){
            $get_image = $request->file('attachment');
            $image_name = str::random(5) . time() . '.' . $get_image->getClientOriginalExtension();
            $location = public_path('uploads/quotations/');
            $get_image->move($location, $image_name);
            $attachment = "uploads/quotations/" . $image_name;
        }

        $lastInsertId = RechargeHistory::insertGetId([
            'user_id' => Auth::user()->id,
            'payment_id' => null,
            'recharge_date' => date('Y-m-d'),
            'recharge_amount' => $request->paid_amount,
            'invitation_limit' => $request->invitation_wanted,
            'agent_no' => 'Custom Quotation',
            'user_no' => 'Custom Quotation',
            'transaction_id' => $request->tran_id,
            'status' => 0,
            'created_at' => Carbon::now(),
        ]);

        Quotation::insert([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'recharge_history_id' => $lastInsertId,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'contact' => $request->contact,
            'paid_amount' => $request->paid_amount,
            'tran_id' => $request->tran_id,
            'invitation_wanted' => $request->invitation_wanted,
            'attachment' => $attachment,
            'slug' => str::random(5) . time(),
            'status' => 0,
            'created_at' => Carbon::now()
        ]);

        return response()->json(['success' => 'Send successfully.']);


    }
}
