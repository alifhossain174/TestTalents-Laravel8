<?php

namespace App\Http\Controllers;

use App\Assesment;
use App\AssesmentTest;
use App\Candidate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\TestQuestion;
use App\Test;
use App\Mail\RequestForSupport;
use App\QuestionBank;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index(){

        $tests = DB::table('tests')
                    ->join('users','tests.user_id','=','users.id')
                    ->where([['users.type',1],['tests.is_active',1]])
                    ->orderBy('tests.id','desc')
                    ->limit(10)
                    ->get();

        return view('frontend.index',compact('tests'));
    }

    public function productTour(){
        return view('frontend.productTour');
    }

    public function pricing(){
        return view('frontend.pricing');
    }

    public function testBank(){
        $tests = DB::table('tests')
                    ->join('users','tests.user_id','=','users.id')
                    ->where('users.type',1)
                    ->where('is_active',1)
                    ->orderBy('tests.id','desc')
                    ->paginate(30);

        return view('frontend.testBank',compact("tests"));
    }

    public function getDataOfTest($slug){
        $data = DB::table('tests')
                    ->join('test_types','tests.test_type','=','test_types.id')
                    ->join('users','tests.user_id','=','users.id')
                    ->select('tests.test_name', 'tests.test_summary', 'tests.test_time', 'tests.test_level', 'test_types.title','users.name as user_name')
                    ->where('tests.slug',$slug)
                    ->first();

        $no_of_questions = TestQuestion::where('test_id',Test::where('slug',$slug)->first()->id)->count();

        $test_level = null;
        if($data->test_level == 1){
            $test_level = "Beginner";
        }
        elseif($data->test_level == 2){
            $test_level = "Intermediate";
        }
        else{
            $test_level = "Expert";
        }
        return response()->json(['data'=> $data, 'no_of_questions' => $no_of_questions, "test_level" => $test_level,]);
    }

    public function requestForSupport(Request $request){
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['msg'] = $request->msg;
        Mail::to("support@testtalents.com")->send(new RequestForSupport($data));
        return response()->json(['data'=>0]);
    }

    public function requestForContact(Request $request){
        $data = array();
        $data['name'] = $request->first_name." ".$request->last_name;
        $data['email'] = $request->email." (".$request->mobile.")";
        $data['msg'] = $request->msg;
        Mail::to("support@testtalents.com")->send(new RequestForSupport($data));
        return response()->json(['data'=>0]);
    }

    public function aboutUs(){
        return view('frontend.about_us');
    }

    public function contactUs(){
        return view('frontend.contact_us');
    }

    public function careerPage(){
        return view('frontend.career');
    }

    public function compilerCode(Request $request){

        if($request->data && $request->pl_code){
            $curl = curl_init();

            $arr = array(
                "clientId" => "39882eb0e8a01aac131f9dfdb89f0bef",
                "clientSecret" => "85e310de734661111fa1d32a469d3b80d9a864ef548a2c704e68b768ec3a4288",
                "script" => $request->data,
                "language" => $request->pl_code,
                "versionIndex" => "0"
            );

            $data = json_encode($arr);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.jdoodle.com/v1/execute',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;

        }
        else{
            echo $response = "Please Select Language and Write Code";
        }

    }

    public function privacyPolicy(){
        return view('frontend.policy');
    }
    public function termsOfUse(){
        return view('frontend.terms');
    }

    public function fullScreenStatusChange(Request $request){

        $candidate_slug = $request->candidate_slug;
        $fullScreenStatus = $request->fullScreenStatus;
        $candidateInfo = Candidate::where('slug',$candidate_slug)->first();
        $assessmentInfo = Assesment::where('slug',$candidateInfo->assesment_slug)->first();
        $noOftestAndQuestion = AssesmentTest::where('assesment_slug',$candidateInfo->assesment_slug)->count();
        if(QuestionBank::where('assesment_id',$assessmentInfo->id)->count() > 0){
            $noOftestAndQuestion++;
        }

        if($fullScreenStatus == 1){
            if($candidateInfo->full_screen_status < $noOftestAndQuestion){
                Candidate::where('slug',$candidate_slug)->increment('full_screen_status',1);
            }
        }
        else{
            Candidate::where('slug',$candidate_slug)->decrement('full_screen_status',1);
        }

        echo "Status has Changed";
    }

    public function mouseStatusChange(Request $request){
        $candidate_slug = $request->candidate_slug;
        Candidate::where('slug',$candidate_slug)->update([
            'mouse_always_inside_tab' => 0
        ]);
        echo "Status has Changed";
    }


    public function searchTest(Request $request){
        if($request->ajax())
        {
            if($request->search != ""){
                $output = "";
                $tests = DB::table('tests')
                            ->join('users','tests.user_id','=','users.id')
                            ->where('tests.test_name','LIKE','%'.$request->search."%")
                            ->whereRaw("users.type = 1")
                            ->where('is_active', 1)
                            ->select('tests.*','users.type as user_type')
                            ->limit(30)
                            ->get();

            }else{
                $output = "";
                $tests = DB::table('tests')
                            ->join('users','tests.user_id','=','users.id')
                            ->whereRaw("users.type = 1")
                            ->where('is_active', 1)
                            ->orderBy('tests.id','desc')
                            ->select('tests.*','users.type as user_type')
                            ->limit(30)
                            ->get();
            }

            if($tests){
                foreach ($tests as $key => $test) {

                    $test_head = "";
                    $test_side_head = "";
                    if($test->user_type != 1){
                        $test_side_head = "<h3 style='font-size: 17px'><i class='far fa-user-circle'></i></h3>";
                    }

                    if($test->test_level == 1){
                        $test_head .= "<i class='fas fa-bars'></i> Easy";
                    }
                    elseif($test->test_level == 2){
                        $test_head .= "<i class='fas fa-chart-bar'></i> Intermediate";
                    }
                    else{
                        $test_head .= "<i class='fas fa-qrcode'></i> Expert";
                    }

                    if(strlen($test->test_name) > 65){
                        $test_name = substr($test->test_name,0,64)."...";
                    }
                    else{
                        $test_name = $test->test_name;
                    }

                    $buttons = "<a href='javascript:void(0)' data-toggle='tooltip' data-id='".$test->slug."' data-original-title='Preview' class='preview previewTest'>Preview</a>";

                    $output .= "<div class='col-lg-4 text-center' id='test_".$test->slug."'>
                    <div class='card' style='height: 345px'>
                        <div class='card-header text-left'>
                            <div class='row p-0 m-0'>
                                <div class='col-lg-6 p-0 m-0'>
                                    <h3>".$test_head."<h3>
                                </div>
                                <div class='col-lg-6 p-0 m-0 text-right text-white'>".$test_side_head."</div>
                            </div>
                        </div>
                        <div class='card-body text-left bg-white'>
                            <h3 id='test_slug_".$test->slug."'>".$test_name."</h3>
                            <p style='margin-bottom: 20px; height: 160px;'>".substr($test->test_summary,0,200)."</p>
                            <div class='row'>
                                <div class='col-lg-6 pt-1'>
                                    <b><i class='fas fa-history'></i></b>".$test->test_time." Min
                                </div>
                                <div class='col-lg-6 text-right'>".$buttons."</div>
                            </div>
                        </div>
                    </div>
                    </div>";
                }
                return Response($output);
            }
        }
    }
}
