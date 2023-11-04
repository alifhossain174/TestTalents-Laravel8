<?php

namespace App\Http\Controllers;
use App\Candidate;
use App\Quotation;
use App\RechargeHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\User;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $userId = Auth::user()->id;

        // auto refilling process start
        $today = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->format('Y-m-d');
        $lastAutoRefill = Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->last_auto_refill)->format('Y-m-d');

        $diff = abs(strtotime($today) - strtotime($lastAutoRefill));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

        if($months >= 1){
            User::where('id', $userId)->increment('current_limit', 5);
            User::where('id', $userId)->update(['last_auto_refill' => Carbon::now()]);
        }
        // auto refilling process end


        // assessments and candidates summary graph start
        $dataRange = array();
        $no_of_invitations = array();
        $attended_test = array();
        $qualified = array();

        $startDate = date("Y-m", strtotime("-0 months"))."-01 00:00:00";
        $endDate = date("Y-m", strtotime("-0 months"))."-31 23:59:59";

        $no_of_invitations[] = Candidate::where('user_id', $userId)->whereBetween('created_at', [$startDate, $endDate])->count();
        $attended_test[] = Candidate::where([['number_of_trial','>=', 1], ['user_id', $userId]])->whereBetween('created_at', [$startDate, $endDate])->count();
        $qualified[] = Candidate::where([['number_of_trial','>=', 1], ['stage', 1], ['user_id', $userId]])->whereBetween('created_at', [$startDate, $endDate])->count();
        $dataRange[] = Carbon::createFromFormat('Y-m-d', date("Y-m-d", strtotime("-7 months")))->format('M-y');

        for($i=6; $i>=0; $i--){
            $startDate = date("Y-m", strtotime("-$i months"))."-01 00:00:00";
            $endDate = date("Y-m", strtotime("-$i months"))."-31 23:59:59";
            $no_of_invitations[] = Candidate::where('user_id', $userId)->whereBetween('created_at', [$startDate, $endDate])->count();
            $attended_test[] = Candidate::where([['number_of_trial','>=', 1], ['user_id', $userId]])->whereBetween('created_at', [$startDate, $endDate])->count();
            $qualified[] = Candidate::where([['number_of_trial','>=',1], ['stage', 1], ['user_id', $userId]])->whereBetween('created_at', [$startDate, $endDate])->count();
            $dataRange[] = Carbon::createFromFormat('Y-m-d', date("Y-m-d", strtotime("-$i months")))->format('M-y');
        }
        // assessments and candidates summary graph end



        // recharge history summary graph start
        $rechargeHistory = array();
        $candidateInvitations = array();

        $startDate = date("Y-m", strtotime("-0 months"))."-01 00:00:00";
        $endDate = date("Y-m", strtotime("-0 months"))."-31 23:59:59";

        $rechargeHistory[] = RechargeHistory::where('user_id', $userId)->whereBetween('created_at', [$startDate, $endDate])->sum('recharge_amount');
        // $candidateInvitations[] = Candidate::where([['number_of_trial','>=', 1], ['user_id', $userId]])->whereBetween('created_at', [$startDate, $endDate])->count();

        for($i=6; $i>=0; $i--){
            $startDate = date("Y-m", strtotime("-$i months"))."-01 00:00:00";
            $endDate = date("Y-m", strtotime("-$i months"))."-31 23:59:59";
            $rechargeHistory[] = RechargeHistory::where('user_id', $userId)->whereBetween('created_at', [$startDate, $endDate])->sum('recharge_amount');
            // $candidateInvitations[] = Candidate::where([['number_of_trial','>=', 1], ['user_id', $userId]])->whereBetween('created_at', [$startDate, $endDate])->count();
        }
        // recharge history summary graph end


        $assesments = DB::table('assessment_owners')
                        ->select('assesments.*', 'assessment_owners.status')
                        ->join('assesments', 'assessment_owners.assessment_id', '=', 'assesments.id')
                        ->where('assessment_owners.user_id', $userId)
                        ->where('assesments.is_deleted', 0)
                        ->orderBy('assesments.id','desc')
                        ->paginate(15);

        return view('backend.dashboard',compact('assesments', 'dataRange', 'no_of_invitations', 'attended_test', 'qualified', 'rechargeHistory'));
    }

    public function viewAllQuotation(Request $request){

        if ($request->ajax()) {
            $data = Quotation::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data) {
                        return date("d M, Y", strtotime($data->created_at));
                    })
                    ->editColumn('validity_given', function($data) {
                        if($data->validity_given)
                            return date("d M, Y", strtotime($data->validity_given));
                    })
                    ->editColumn('name', function($data) {
                        $userInfo = User::where('id', $data->user_id)->first();
                        return $data->name . "<br>".$data->email."<br>Limit: ".$userInfo->current_limit ." (".date("d-m-Y", strtotime($userInfo->expire_date)).")";
                    })
                    ->editColumn('paid_amount', function($data) {
                        return "Limit: ".$data->invitation_wanted . "<br>BDT ". $data->paid_amount;
                    })
                    ->editColumn('invitation_given', function($data) {
                        return "Limit: ".$data->invitation_given;
                    })
                    ->editColumn('status', function($data) {

                        if ($data->status == 0){
                            return '<span class="alert alert-info font-weight-bold" style="font-size: 12px; padding: 3px 6px; color: #1e1e1e;">Pending</span>';
                        } elseif($data->status == 1){
                            return '<span class="alert alert-success font-weight-bold" style="font-size: 12px; padding: 3px 6px; color: #1e1e1e;">Approved</span>';
                        } else{
                            return '<span class="alert alert-danger font-weight-bold" style="font-size: 12px; padding: 3px 6px; color: #1e1e1e;">Cancelled</span>';
                        }

                    })
                    ->addColumn('attachment', function($data){
                        $btn = '<a href="'. url('/') . $data->attachment. '" style="background-color: #1D4354; color: white; text-shadow: 1px 1px 2px black; padding: 3px 8px;" class="btn btn-sm"><i class="fas fa-download"></i> Download</a>';
                        return $btn;
                    })
                    ->addColumn('action', function($data){
                        $btn = '';
                        if ($data->status == 0){
                            $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->slug.'" data-original-title="Approve" class="btn btn-success btn-sm m-1 approveQuotation" style="font-size: 12px; font-weight: 700;"><i class="fas fa-check"></i></a>';
                            $btn .= '<a href="'.url('cancel/quotation').'/'.$data->slug.'" class="btn btn-danger btn-sm m-1" style="font-size: 12px; font-weight: 700;"><i class="fas fa-trash-alt"></i></a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'attachment', 'name', 'paid_amount', 'invitation_given', 'status'])
                    ->make(true);
        }

        return view('backend.quotations');
    }

    public function cancelQuotation($slug){
        $quotation = Quotation::where('slug', $slug)->first();
        $quotation->status = 2;
        $quotation->save();

        $rechargeInfo = RechargeHistory::where('id', $quotation->recharge_history_id)->first();
        $rechargeInfo->status = 2;
        $rechargeInfo->save();

        Toastr::error('Quotation Declined', 'Declined');
        return back();
    }

    public function getQuotationInfo($slug){
        $data = Quotation::where('slug', $slug)->first();
        return response()->json($data);
    }

    public function updateQuotation(Request $request){

        $quotation = Quotation::where('slug', $request->quotation_slug)->first();
        $quotation->status = 1;
        $quotation->invitation_given = $request->approved_limit;
        $quotation->validity_given = $request->expire_date;
        $quotation->save();


        $userInfo = User::where('id', $quotation->user_id)->first();
        $userInfo->current_limit = $userInfo->current_limit + $request->approved_limit;
        $userInfo->expire_date = date('Y-m-d', strtotime($request->expire_date));
        $userInfo->updated_at = Carbon::now();
        $userInfo->save();


        $rechargeInfo = RechargeHistory::where('id', $quotation->recharge_history_id)->first();
        $rechargeInfo->status = 1;
        $rechargeInfo->invitation_limit = $request->approved_limit;
        $rechargeInfo->save();

        return response()->json(['success' => 'Deleted successfully.']);
    }
}
