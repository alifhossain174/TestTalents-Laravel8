<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\CandidateResult;
use App\CandidateRecording;
use App\Candidate;
use App\Assesment;
use App\AssessmentOwner;
use App\CandidateTestimonial;
use App\Mail\InvitationForEvaluation;
use App\WebcamImages;
use App\MCQ;
use PDF;
use App\Test;
use App\QuestionBank;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\ZoomMeetingTrait;
use Illuminate\Support\Str;
use App\ZoomMeeting;
use App\Mail\ZoomMeetingMail;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DataTables;
use Yajra\DataTables\Services\DataTable;

class CandidateController extends Controller
{
    use ZoomMeetingTrait;
    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function uploadAudio(Request $request){

        $output = $_FILES['audio_data']['name'].".wav";
        $filepath = public_path('recordings/');
        // $filepath = 'recordings/'; //for aws linux server
        move_uploaded_file($_FILES["audio_data"]["tmp_name"], $filepath.$output);

        CandidateRecording::insert([
            'candidate_id' => Candidate::where('slug',$_POST['candidate_slug'])->first()->id,
            'assesment_id' => Assesment::where('slug',$_POST['assesment_slug'])->first()->id,
            'question_id' => $_POST['question_id'],
            'file_name' => $output,
            'created_at' => Carbon::now()
        ]);

        Candidate::where('slug',$_POST['candidate_slug'])->where('assesment_slug',$_POST['assesment_slug'])->increment('sound_taken');

    }

    public function testAnswerSubmit(Request $request,$start){

        try {

            if(isset($_POST['webcam'])){
                // webcam image upload start
                $img = $_POST['webcam'];
                $folderPath = public_path('webcamImages/');
                // $folderPath = 'webcamImages/'; //for aws linux server
                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = time().uniqid() . '.png';
                $file = $folderPath . $fileName;
                file_put_contents($file, $image_base64);
            }

            if(isset($_POST['webcam'])){
                WebcamImages::insert([
                    'candidate_id' => Candidate::where('slug',$request->candidate_slug)->first()->id,
                    'assesment_id' => Assesment::where('slug',$request->assesment_slug)->first()->id,
                    'file_name' => $fileName,
                    'created_at' => Carbon::now()
                ]);
                Candidate::where('slug',$request->candidate_slug)->where('assesment_slug',$request->assesment_slug)->increment('webcam');
            }
            // webcam image upload end

            $candidate_id = Candidate::where('slug', $request->candidate_slug)->first()->id;

            if($request->test_slug != ''){
                CandidateResult::where('candidate_id',$candidate_id)->where('email',$request->client_email)->where('assesment_slug',$request->assesment_slug)->where('test_slug',$request->test_slug)->where('question_id',$request->question_id)->delete();
            }
            else{
                CandidateResult::where('candidate_id',$candidate_id)->where('email',$request->client_email)->where('assesment_slug',$request->assesment_slug)->where('test_slug',null)->where('question_id',$request->question_id)->delete();
            }

            $lastInsertedResultId = CandidateResult::insertGetId([
                'email' => $request->client_email,
                'candidate_id' => $candidate_id,
                'assesment_slug' => $request->assesment_slug,
                'assesment_id' => Assesment::where('slug',$request->assesment_slug)->first()->id,
                'question_id' => $request->question_id,
                'question_slug' => QuestionBank::where('id',$request->question_id)->first()->slug,
                // 'answer' => $request->open_ended_answer,
                'created_at' => Carbon::now()
            ]);

            Candidate::where('id', $candidate_id)->update(['last_question_time_used' => 0]);

            if($request->test_slug != ''){
                CandidateResult::where('id',$lastInsertedResultId)->update([
                    'test_slug' => $request->test_slug,
                    'test_id' => Test::where('slug',$request->test_slug)->first()->id,
                ]);
            }

            $questionType = QuestionBank::where('id',$request->question_id)->first()->question_type;
            $questionMarks = QuestionBank::where('id',$request->question_id)->first()->marks;
            $rightAnswer = QuestionBank::where('id',$request->question_id)->first()->answer;
            $options = MCQ::where('question_id',$request->question_id)->get();

            if($questionType == 1 || $questionType == 3){
                $data = array();
                $data = $request->answer;

                // because array index starts from 0
                if($data != ''){
                    if(isset($options[$rightAnswer-1]->mc)){
                        if($options[$rightAnswer-1]->mc == $data[0]){
                            $marks = $questionMarks;
                        }
                        else{
                            $marks = 0;
                        }
                    }
                    else{
                        $marks = 0;
                    }
                }
                else{
                    $marks = 0;
                }

                CandidateResult::where('id',$lastInsertedResultId)->update([
                    'answer' => $data != '' ? $data[0] : null,
                    'marks' => $marks
                ]);
            }
            elseif($questionType == 2 || $questionType == 4){
                CandidateResult::where('id',$lastInsertedResultId)->update([
                    'answer' => $request->open_ended_answer,
                ]);
            }
            else{
                CandidateResult::where('id',$lastInsertedResultId)->update([
                    'answer' => $request->code_answer,
                    'pl_code' => $request->programming_language,
                ]);
            }
            return response()->json(['success'=>'Answer submitted successfully.']);

        }
        catch(\Exception $e) {
            return response()->json(['Failed'=>'Duplicate Entry']);
        }
    }

    public function seeAllCandidates($slug, Request $request){

        if ($request->ajax()) {

            $data = Candidate::where('assesment_slug', $slug)->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('email', function(Candidate $data) {

                        $sameIpCount = 0;
                        if ($data->ip_address != null) {
                            $sameIpCount = Candidate::where('assesment_slug', $data->assesment_slug)
                                ->where('ip_address', $data->ip_address)
                                ->count();
                        }

                        if ($sameIpCount > 1){
                            return "<a onclick='SameIP()' title='Another Candidate has given Assessment From Same IP' style='color:#d20000;font-size:10px;cursor:pointer'><i class='fas fa-circle'></i></a> ". $data->email;
                        } else {
                            return $data->email;
                        }

                    })
                    ->editColumn('invited_on', function(Candidate $data) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $data->invited_on)->format('d M, Y h:i A');
                    })
                    ->editColumn('average_score', function(Candidate $data) {
                        return CandidateResult::where('candidate_id', $data->id)->where('evaluator_id', Auth::user()->id)->sum('marks');
                    })
                    ->editColumn('stage', function(Candidate $data) {

                        if ($data->stage == 0){
                            return '<span class="alert alert-danger p-1 font-weight-bold" style="font-size: 13px">Not Checked</span>';
                        } elseif($data->stage == 2){
                            return '<span class="alert alert-warning p-1 font-weight-bold" style="font-size: 13px">Not Evaluated</span>';
                        } else{
                            return '<span class="alert alert-success p-1 font-weight-bold" style="font-size: 13px">Evaluated</span>';
                        }

                    })
                    ->addColumn('action', function(Candidate $data){
                        $btn = '<a href="'.url('candidate/marks') . '/' . $data->slug.'" title="Marking"><img src="'.url('/marking_color.png').'" width="25"></a>';

                        $assesment_info = Assesment::where('slug', $data->assesment_slug)->first();
                        $assessmentOwner = DB::table('assessment_owners')->where('assessment_id', $assesment_info->id)->where('user_id', Auth::user()->id)->where('status', 1)->first();
                        if($assessmentOwner){
                            $btn .= ' <a href="'.url('candidate/result') .'/'. $data->slug .'" title="Result"><img src="'.url('/report-card.png').'" width="30" height="27"></a>';

                            $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $candidate->slug }}" title="Testimonial" data-original-title="Testimonial" class="testimonial"><img src="'.url('/testimonial.png').'" width="27" height="27"></a>';
                        }

                        return $btn;
                    })
                    ->rawColumns(['action', 'email', 'stage'])
                    ->make(true);
        }

        $no_of_candiates = Candidate::where('assesment_slug',$slug)->count();

        $assesment_info = Assesment::where('slug',$slug)->first();
        $assesmentTests = DB::table('assesment_tests')
                            ->join('tests','assesment_tests.test_id','=','tests.id')
                            ->where('assesment_tests.assesment_slug',$slug)
                            ->select('tests.*')
                            ->get();
        $assesmentQuestions = QuestionBank::where('assesment_id',$assesment_info->id)->get();

        $chrome_users = Candidate::where('assesment_slug',$slug)->where('browser_used','Chrome')->count();
        $firefox_users = Candidate::where('assesment_slug',$slug)->where('browser_used','Firefox')->count();
        $safari_users = Candidate::where('assesment_slug',$slug)->where('browser_used','Safari')->count();
        $others_users = Candidate::where('assesment_slug',$slug)->whereNotNull('browser_used')->whereNotIn('browser_used', ["Chrome","Firefox","Safari"])->count();

        $windows_users = Candidate::where('assesment_slug',$slug)->where('os_used', 'like', '%Windows%')->count();
        $mac_users = Candidate::where('assesment_slug',$slug)->where('os_used', 'like', '%Mac%')->count();
        $other_os_users = Candidate::where('assesment_slug',$slug)->whereNotNull('os_used')->where([['os_used', 'not like', '%Mac%'], ['os_used', 'not like', '%Windows%']])->count();

        $assessmentOwner = DB::table('assessment_owners')->where('assessment_id', $assesment_info->id)->where('user_id', Auth::user()->id)->where('status', 1)->first();

        $assessmentEvaluators = DB::table('assessment_owners')
                                    ->select('assessment_owners.id', 'assessment_owners.slug', 'users.name', 'users.email', 'assessment_owners.created_at', 'users.account_type')
                                    ->join('users', 'users.id', '=', 'assessment_owners.user_id')
                                    ->where('assessment_id', $assesment_info->id)
                                    ->where('status', 2)
                                    ->paginate(10);

        return view('backend.candidates',compact('assesment_info','assesmentTests','assesmentQuestions','no_of_candiates','chrome_users','firefox_users','safari_users','others_users','windows_users','mac_users','other_os_users', 'assessmentOwner', 'assessmentEvaluators'));

    }

    public function seeAllCandidatesFiltered($slug, $webcam_filter, $mic_filter, $screen_filter, Request $request){
        if ($request->ajax()) {

            $data = Candidate::where('assesment_slug', $slug)
                    ->when($webcam_filter, function($query) use ($webcam_filter){
                        if($webcam_filter == 1)
                            return $query->where('webcam', '>', 0);
                        if($webcam_filter == 2)
                            return $query->where('webcam', '<=', 0);
                    })
                    ->when($mic_filter, function($query) use ($mic_filter){
                        if($mic_filter == 1)
                            return $query->where('sound_taken', '>', 0);
                        if($mic_filter == 2)
                            return $query->where('sound_taken', '<=', 0);
                    })
                    ->when($screen_filter, function($query) use ($screen_filter){
                        if($screen_filter == 1)
                            return $query->where('full_screen_status', '>', 0);
                        if($screen_filter == 2)
                            return $query->where('full_screen_status', '<=', 0);
                    })
                    ->orderBy('id', 'desc')
                    ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('email', function(Candidate $data) {
                        $sameIpCount = 0;
                        if ($data->ip_address != null) {
                            $sameIpCount = Candidate::where('assesment_slug', $data->assesment_slug)
                                ->where('ip_address', $data->ip_address)
                                ->count();
                        }

                        if ($sameIpCount > 1){
                            return "<a onclick='SameIP()' title='Another Candidate has given Assessment From Same IP' style='color:#d20000;font-size:10px;cursor:pointer'><i class='fas fa-circle'></i></a> ". $data->email;
                        } else {
                            return $data->email;
                        }
                    })
                    ->editColumn('invited_on', function(Candidate $data) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $data->invited_on)->format('d M, Y h:i A');
                    })
                    ->editColumn('average_score', function(Candidate $data) {
                        return CandidateResult::where('candidate_id', $data->id)->where('evaluator_id', Auth::user()->id)->sum('marks');
                    })
                    ->editColumn('stage', function(Candidate $data) {
                        if ($data->stage == 0){
                            return '<span class="alert alert-danger p-1 font-weight-bold" style="font-size: 13px">Not Checked</span>';
                        } elseif($data->stage == 2){
                            return '<span class="alert alert-warning p-1 font-weight-bold" style="font-size: 13px">Not Evaluated</span>';
                        } else{
                            return '<span class="alert alert-success p-1 font-weight-bold" style="font-size: 13px">Evaluated</span>';
                        }
                    })
                    ->addColumn('action', function(Candidate $data){
                        $btn = '<a href="'.url('candidate/marks') . '/' . $data->slug.'" title="Marking"><img src="'.url('/marking_color.png').'" width="25"></a>';
                        $assesment_info = Assesment::where('slug', $data->assesment_slug)->first();
                        $assessmentOwner = DB::table('assessment_owners')->where('assessment_id', $assesment_info->id)->where('user_id', Auth::user()->id)->where('status', 1)->first();
                        if($assessmentOwner){
                            $btn .= ' <a href="'.url('candidate/result') .'/'. $data->slug .'" class="btn-sm btn-info rounded"><i class="far  fa-file-alt"></i> Report</a>';
                            $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $candidate->slug }}" data-original-title="Testimonial" title="Testimonial" class="testimonial"><img src="'.url('/testimonial.png').'" width="27" height="27"></a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'email', 'stage'])
                    ->make(true);
        }
    }

    public function giveMarks($slug){

        $candidateInfo = Candidate::where('slug',$slug)->first();
        if(CandidateResult::where('candidate_id', $candidateInfo->id)->exists()){
            Candidate::where('slug',$slug)->update([
                'stage' => 2,
                'updated_at' => Carbon::now()
            ]);
        }

        if(CandidateResult::where('candidate_id', $candidateInfo->id)->where('evaluator_id', NULL)->exists()){
            $results = DB::table('candidate_results')
                        ->join('question_banks','candidate_results.question_id','question_banks.id')
                        ->where('candidate_id', $candidateInfo->id)
                        ->where('evaluator_id', NULL)
                        ->select('candidate_results.*','question_banks.question','question_banks.question_type', 'question_banks.user_id as question_created_by')
                        ->orderBy('candidate_results.id', 'ASC')
                        ->get();
        } else {

            if(CandidateResult::where('candidate_id', $candidateInfo->id)->where('evaluator_id', Auth::user()->id)->exists()){
                $results = DB::table('candidate_results')
                            ->join('question_banks','candidate_results.question_id','question_banks.id')
                            ->where('candidate_id', $candidateInfo->id)
                            ->where('evaluator_id', Auth::user()->id)
                            ->select('candidate_results.*','question_banks.question','question_banks.question_type', 'question_banks.user_id as question_created_by')
                            ->orderBy('candidate_results.id', 'ASC')
                            ->get();
            } else {
                $randomEvaluator = CandidateResult::where('candidate_id', $candidateInfo->id)->first();
                $results = DB::table('candidate_results')
                            ->join('question_banks','candidate_results.question_id','question_banks.id')
                            ->where('candidate_id', $candidateInfo->id)
                            // ->where('evaluator_id', $randomEvaluator->evaluator_id)
                            ->when($randomEvaluator, function($query) use ($randomEvaluator){
                                return $query->where('evaluator_id', $randomEvaluator->evaluator_id);
                            })
                            ->select('candidate_results.*','question_banks.question','question_banks.question_type', 'question_banks.user_id as question_created_by')
                            ->orderBy('candidate_results.id', 'ASC')
                            ->get();
            }


        }


        $webcamImages = WebcamImages::where('candidate_id',$candidateInfo->id)->where('assesment_id',Assesment::where('slug',$candidateInfo->assesment_slug)->first()->id)->get();
        $webcamImagesArray = array();
        foreach($webcamImages as $webcamImage){
            $webcamImagesArray[] = $webcamImage->file_name;
        }
        return view('backend.client.marks',compact('results', 'webcamImagesArray', 'candidateInfo'));
    }

    public function saveMarks(Request $request){

        if($request->question_id){

            $i = 0;
            $average_score = 0;
            $candidateInfo = Candidate::where('slug',$request->candidate_slug)->first();

            foreach($request->question_id as $item){

                $candidateResult = CandidateResult::where('candidate_id', $candidateInfo->id)->where('question_id', $item)->where('evaluator_id', NUll)->first();
                if($candidateResult){
                    $candidateResult->evaluator_id = Auth::user()->id;
                    $candidateResult->marks = $request->marks[$i];
                    $candidateResult->updated_at = Carbon::now();
                    $candidateResult->save();
                } else {
                    $candidateResultEvaluatorUpdate = CandidateResult::where('candidate_id', $candidateInfo->id)->where('question_id', $item)->where('evaluator_id', Auth::user()->id)->first();
                    if($candidateResultEvaluatorUpdate){
                        $candidateResultEvaluatorUpdate->marks = $request->marks[$i];
                        $candidateResultEvaluatorUpdate->updated_at = Carbon::now();
                        $candidateResultEvaluatorUpdate->save();
                    } else{
                        $candidateResultNewEvaluator = CandidateResult::where('candidate_id', $candidateInfo->id)->where('question_id',$item)->first();
                        CandidateResult::insert([
                            'candidate_id' => $candidateResultNewEvaluator->candidate_id,
                            'evaluator_id' => Auth::user()->id,
                            'email' => $candidateResultNewEvaluator->email,
                            'assesment_slug' => $candidateResultNewEvaluator->assesment_slug,
                            'assesment_id' => $candidateResultNewEvaluator->assesment_id,
                            'test_slug' => $candidateResultNewEvaluator->test_slug,
                            'test_id' => $candidateResultNewEvaluator->test_id,
                            'question_slug' => $candidateResultNewEvaluator->question_slug,
                            'question_id' => $candidateResultNewEvaluator->question_id,
                            'pl_code' => $candidateResultNewEvaluator->pl_code,
                            'answer' => $candidateResultNewEvaluator->answer,
                            'marks' => $request->marks[$i],
                            'created_at' => Carbon::now(),
                        ]);
                    }
                }

                $average_score = $average_score + CandidateResult::where('candidate_id', $candidateInfo->id)->where('question_id',$item)->avg('marks');
                $i++;
            }

            Candidate::where('slug',$request->candidate_slug)->update([
                'stage' => 1,
                'updated_at' => Carbon::now(),
                'average_score' => $average_score
            ]);

            Toastr::success('Candidate Evaluated', 'Successfully');
            return redirect('see/candidates/'.$candidateInfo->assesment_slug);

        }
        else{
            Toastr::error('No Answer Found', 'Not Found');
            return redirect()->back();
        }
    }

    public function viewResult($slug){

        $candidateInfo = Candidate::where('slug',$slug)->first();
        $candidateResult = CandidateResult::where('candidate_id',$candidateInfo->id)->get();
        $candidateTestimonials = CandidateTestimonial::where('candidate_id',$candidateInfo->id)->where('status', 1)->orderBy('id','desc')->get();

        $givenTests = DB::table('candidate_results')
                        ->join('tests','candidate_results.test_id','=','tests.id')
                        ->select('candidate_results.*','tests.test_name')
                        ->where('candidate_results.test_id','!=',null)
                        ->where('evaluator_id', Auth::user()->id)
                        ->where('candidate_results.candidate_id',$candidateInfo->id)
                        ->where('candidate_results.assesment_slug',$candidateInfo->assesment_slug)
                        ->groupBy('candidate_results.test_id')
                        ->get();

        $givenQuestions = DB::table('candidate_results')
                        ->join('question_banks','candidate_results.question_id','=','question_banks.id')
                        ->select('candidate_results.*','question_banks.question')
                        ->where('candidate_results.test_id',null)
                        ->where('evaluator_id', Auth::user()->id)
                        ->where('candidate_results.candidate_id',$candidateInfo->id)
                        ->where('candidate_results.assesment_slug',$candidateInfo->assesment_slug)
                        ->get();

        $evaluatorsEvaluations = DB::table('candidate_results')
                        ->join('users','candidate_results.evaluator_id','=','users.id')
                        ->select('candidate_results.evaluator_id', 'users.name as username')
                        ->where('evaluator_id', '!=', Auth::user()->id)
                        ->where('candidate_results.candidate_id',$candidateInfo->id)
                        ->where('candidate_results.assesment_slug',$candidateInfo->assesment_slug)
                        ->groupBy('evaluator_id')
                        ->get();

        // $webcamImages = WebcamImages::where('candidate_id',$candidateInfo->id)->where('assesment_id',Assesment::where('slug',$candidateInfo->assesment_slug)->first()->id)->get();
        return view('backend.client.result',compact('candidateInfo','candidateResult','givenTests','givenQuestions','candidateTestimonials', 'evaluatorsEvaluations'));
    }

    public function printResult($slug){

        $candidateInfo = Candidate::where('slug',$slug)->first();
        $candidateResult = CandidateResult::where('candidate_id',$candidateInfo->id)->get();
        $assessmentInfo = Assesment::where('slug',$candidateInfo->assesment_slug)->first();

        $givenTests = DB::table('candidate_results')
                        ->join('tests','candidate_results.test_id','=','tests.id')
                        ->select('candidate_results.*','tests.test_name')
                        ->where('candidate_results.test_id','!=',null)
                        ->where('candidate_results.evaluator_id', isset($candidateResult[0]) ? $candidateResult[0]->evaluator_id : 0)
                        ->where('candidate_results.candidate_id',$candidateInfo->id)
                        ->where('candidate_results.assesment_slug',$candidateInfo->assesment_slug)
                        ->groupBy('candidate_results.test_id')
                        ->get();

        $givenQuestions = DB::table('candidate_results')
                        ->join('question_banks','candidate_results.question_id','=','question_banks.id')
                        ->select('candidate_results.*','question_banks.question')
                        ->where('candidate_results.test_id',null)
                        ->where('candidate_results.evaluator_id', isset($candidateResult[0]) ? $candidateResult[0]->evaluator_id : 0)
                        ->where('candidate_results.candidate_id',$candidateInfo->id)
                        ->where('candidate_results.assesment_slug',$candidateInfo->assesment_slug)
                        ->get();

        $evaluatorsEvaluations = DB::table('candidate_results')
                        ->select('evaluator_id')
                        ->where('candidate_id', $candidateInfo->id)
                        ->where('assesment_slug', $candidateInfo->assesment_slug)
                        ->groupBy('evaluator_id')
                        ->get();

        $webcamImages = WebcamImages::where('candidate_id',$candidateInfo->id)->where('assesment_id',Assesment::where('slug',$candidateInfo->assesment_slug)->first()->id)->get();

        $pdf = PDF::loadView('backend.client.report',compact('candidateInfo', 'candidateResult', 'assessmentInfo', 'givenTests', 'givenQuestions', 'webcamImages', 'evaluatorsEvaluations'));
        return $pdf->stream('report.pdf');
    }

    public function updateUsedTimeOfLastQuetion(Request $request){
        if($request->timeUsed && $request->candidate_slug){
            Candidate::where('slug', $request->candidate_slug)->update([
                'last_question_time_used' => round($request->timeUsed,2)
            ]);
            return response()->json(['success'=>'Time Updated Successfully']);
        }
    }

    public function getCandidateInfo($slug){
        $data = Candidate::where('slug',$slug)->first();
        return response()->json(['data'=> $data]);
    }

    public function createMeetingLink(Request $request){

        $data = array();
        $data['host_email'] = $request->host_email;
        $data['topic'] = $request->meeting_topic;
        $data['type'] = CandidateController::MEETING_TYPE_SCHEDULE;
        $data['start_time'] = $request->start_time;
        $data['duration'] = $request->duration;
        $data['host_video'] = 1;
        $data['participant_video'] = 1;
        $result = $this->create($data);

        ZoomMeeting::insert([
            'assessment_id' => Assesment::where('slug',$request->assessment_slug)->first()->id,
            'candidate_id' => Candidate::where('slug',$request->candidate_slug)->first()->id,
            'user_id' => Auth::user()->id,
            'zoom_uuid' => $result['data']['uuid'],
            'zoom_id' => $result['data']['id'],
            'zoom_host_id' => $result['data']['host_id'],
            'zoom_host_email' => $result['data']['host_email'],
            'zoom_topic' => $result['data']['topic'],
            'zoom_type' => CandidateController::MEETING_TYPE_SCHEDULE,
            'zoom_status' => $result['data']['status'],
            'zoom_start_time' => $result['data']['start_time'],
            'zoom_duration' => $result['data']['duration'],
            'zoom_timezone' => $result['data']['timezone'],
            'zoom_start_url' => $result['data']['start_url'],
            'zoom_join_url' => $result['data']['join_url'],
            'zoom_password' => $result['data']['password'],
            'zoom_h323_password' => $result['data']['h323_password'],
            'zoom_pstn_password' => $result['data']['pstn_password'],
            'zoom_encrypted_password' => $result['data']['encrypted_password'],
            'zoom_settings_host_video' => 1,
            'zoom_settings_participant_video' => 1,
            'slug' => time().str::random(5),
            'created_at' => Carbon::now(),
        ]);

        $data['join_url'] = $result['data']['join_url'];
        Mail::to(trim(Candidate::where('slug',$request->candidate_slug)->first()->email))->send(new ZoomMeetingMail($data));

        return response()->json(['success'=>'Zoom Meeting Link successfully.']);

    }

    public function getMeetingInfo($slug){
        $data = ZoomMeeting::where('slug',$slug)->first();
        return response()->json(['data'=> $data]);
    }

    public function getZoomMeetingDetails($id){
        print_r($this->get($id));
    }

    public function deleteZoomMeeting($id){
        print_r($this->delete($id));
    }

    public function sendInvitationForEvaluation(Request $request){

        $assessmentInfo = Assesment::where('slug', $request->assessment_slug)->first();

        foreach ($request->email as $email) {

            $data = array();
            $data['email'] = $email;
            $data['password'] = '';
            $data['assessment_slug'] = $assessmentInfo->slug;

            $password = '';
            $userInfo = User::where('email', $email)->first();
            if(!$userInfo){

                $password = time();
                $data['password'] = $password;

                $user_id = User::insertGetId([
                    'name' => explode("@", $email)[0],
                    'email' => $email,
                    'password' => Hash::make($password),
                    'email_verified_at' => Carbon::now(),
                    'type' => 3, //user
                    'account_type' => 2, // auto account created for Assessment Evaluation
                    'current_limit' => 0,
                    'created_at' => Carbon::now()
                ]);
                $userInfo = User::where('id', $user_id)->first();
            }

            $checkAlreadyOwner = AssessmentOwner::where('user_id', $userInfo->id)->where('assessment_id', $assessmentInfo->id)->first();
            if(!$checkAlreadyOwner){
                AssessmentOwner::insert([
                    'user_id' => $userInfo->id,
                    'assessment_id' => $assessmentInfo->id,
                    'status' => 2, // Requested User For Evaluation
                    'slug' => time().str::random(5),
                    'created_at' => Carbon::now(),
                ]);
            }

            Mail::to(trim($email))->send(new InvitationForEvaluation($data));
        }

        return response()->json(['success' => 'Invitation Send Successfull']);

    }

    public function removeEvaluator($slug){
        AssessmentOwner::where('slug', $slug)->delete();
        Toastr::error('Evaluator Removed', 'Successfully');
        return back();
    }
}
