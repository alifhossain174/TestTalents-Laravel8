<?php

namespace App\Http\Controllers;

use App\RechargeHistory;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\PaymentRequestReceived;
use App\Mail\PaymentRequestApprove;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;

class RechargeController extends Controller
{
    public function billingPage(){
        if(Auth::user()->type == 1){
            $histories = RechargeHistory::orderBy('id','desc')->paginate(15);
            return view('backend.recharge.billing',compact('histories'));
        }
        else{
            $histories = RechargeHistory::where('user_id', Auth::user()->id)->orderBy('id','desc')->paginate(15);
            return view('backend.recharge.billing',compact('histories'));
        }
    }

    public function saveRechargeInfo(Request $request){

        $lastInsertId = RechargeHistory::insertGetId([
            'user_id' => Auth::user()->id,
            'recharge_date' => date('Y-m-d'),
            'recharge_amount' => $request->amount,
            'agent_no' => $request->agent_no,
            'user_no' => $request->user_no,
            'transaction_id' => $request->transaction_id,
            'created_at' => Carbon::now(),
        ]);

        $email = Auth::user()->email;

        $rechargeInfo = DB::table('recharge_histories')
                        ->join('users','users.id','=','recharge_histories.user_id')
                        ->select('recharge_histories.*','users.*')
                        ->where('recharge_histories.id',$lastInsertId)
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

        Mail::to(trim($email))->send(new PaymentRequestReceived($data));

        return response()->json(['success'=>'Recharge Successfull.']);
    }

    public function deniedRechargeReq($id){
        RechargeHistory::where('id',$id)->update([
            'status' => 2,
            'updated_at' => Carbon::now()
        ]);
        Toastr::error('Recharge Request Denied', 'Denied');
        return back();
    }

    public function getRechargeInfo($id){
        if(Auth::user()->type == 1){
            $userInfo = User::where('id',RechargeHistory::where('id',$id)->first()->user_id)->first();
            return response()->json(['data'=> $userInfo]);
        }
    }

    public function approveRechargeRequest(Request $request){
        User::Where('id',$request->user_id)->update([
            'current_limit' => $request->current_balance,
            'expire_date' => $request->expire_date,
            'updated_at' => Carbon::now()
        ]);

        RechargeHistory::where('id',$request->recharge_id)->update([
            'status' => 1,
            'updated_at' => Carbon::now()
        ]);


        $email = Auth::user()->email;

        $rechargeInfo = DB::table('recharge_histories')
                        ->join('users','users.id','=','recharge_histories.user_id')
                        ->select('recharge_histories.*','users.*')
                        ->where('recharge_histories.id',$request->recharge_id)
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

        Mail::to(trim($email))->send(new PaymentRequestApprove($data));

        return response()->json(['success'=>'Recharge Successfull.']);
    }
}
