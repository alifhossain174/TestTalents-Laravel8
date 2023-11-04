<?php

namespace App\Http\Controllers;

use App\JobRole;
use App\Assesment;
use App\QuestionBank;
use App\AssesmentTest;
use App\AssessmentOwner;
use App\Test;
use App\User;
use App\Candidate;
use App\MCQ;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\SendLink;
use Illuminate\Support\Facades\Mail;
// use App\Traits\ZoomMeetingTrait;

class AssesmentController extends Controller
{
    // use ZoomMeetingTrait;
    // const MEETING_TYPE_INSTANT = 1;
    // const MEETING_TYPE_SCHEDULE = 2;
    // const MEETING_TYPE_RECURRING = 3;
    // const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    // public function zoomMeeting(){
    //     $data = array();
    //     $data['host_email'] = "alifhossain174@gmail.com";
    //     $data['topic'] = "Monir Vai";
    //     $data['type'] = AssesmentController::MEETING_TYPE_SCHEDULE;
    //     $data['start_time'] = "2021-11-20 18:00:00";
    //     $data['duration'] = 2;
    //     $data['host_video'] = 1;
    //     $data['participant_video'] = 1;
    //     $result = $this->create($data);
    //     echo "<pre>";
    //     print_r($result);
    // }

    public function createAssesmentFirstStep()
    {
        // $job_roles = JobRole::orderBy('title', 'asc')->get();
        return view('backend.assesment.createFirstStep');
    }

    public function saveAssesmentFirstStep(Request $request)
    {
        $last_assesment_inserted_id = Assesment::insertGetId([
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'field' => $request->field,
            'job_role' => $request->job_role,
            'slug' => time() . str::random(10),
            'created_at' => Carbon::now()
        ]);
        session(['last_assesment_inserted_id' => $last_assesment_inserted_id]);
        return redirect('create/assesment/secondstep');
    }

    public function createAssesmentSecondStep()
    {
        $tests = DB::table('tests')
            ->join('users', 'tests.user_id', '=', 'users.id')
            ->where([['users.type', 1], ['tests.is_active', 1]])
            ->orWhere([['user_id', Auth::user()->id], ['tests.is_active', 1]])
            ->orderBy('tests.id', 'desc')
            ->select('tests.*', 'users.type as user_type')
            ->paginate(90);

        return view('backend.assesment.createSecondStep', compact("tests"));
    }

    public function saveAssesmentSecondStep(Request $request)
    {
        $inserted_assesment_id = session('last_assesment_inserted_id');
        $assementInfo = Assesment::where('id', $inserted_assesment_id)->first();
        $total_marks = 0;
        $total_mins = 0;

        if (isset($request->tests)) {
            foreach ($request->tests as $test) {
                $testInfo = Test::where('slug', $test)->first();
                $total_marks = $total_marks + $testInfo->total_marks;
                $total_mins = $total_mins + $testInfo->test_time;
                AssesmentTest::insert([
                    'assesment_id' => $inserted_assesment_id,
                    'assesment_slug' => $assementInfo->slug,
                    'test_id' => $testInfo->id,
                    'test_slug' => $testInfo->slug,
                ]);
            }
            Assesment::where('id', $inserted_assesment_id)->update([
                'total_marks' => $total_marks,
                'total_mins' => $total_mins,
                'updated_at' => Carbon::now()
            ]);
        };
        return redirect('create/assesment/thirdstep');
    }

    public function createAssesmentThirdStep()
    {
        $inserted_assesment_id = session('last_assesment_inserted_id');
        $assementInfo = Assesment::where('id', $inserted_assesment_id)->first();
        $questions = QuestionBank::where('assesment_id', $assementInfo->id)->get();
        $count_question = QuestionBank::where('assesment_id', $assementInfo->id)->count();
        return view('backend.assesment.createThirdStep', compact('questions', 'count_question'));
    }

    public function addCustomQuestionToAssesment()
    {
        return view('backend.assesment.addCustomQuestion');
    }

    public function saveCustomQuestionToAssesment(Request $request)
    {

        // MCQ Null Validation start
        if($request->question_type == 1 || $request->question_type == 3){
            foreach($request->mcq as $mcq){
                if($mcq == ''){
                    Toastr::error('Sorry! MCQ Option Cannot be Null', 'Success');
                    return redirect()->back();
                }
            }
        }
        // MCQ Null Validation end

        $inserted_assesment_id = session('last_assesment_inserted_id');
        $questionBank = new QuestionBank();
        $questionBank->user_id = Auth::user()->id;
        $questionBank->assesment_id = $inserted_assesment_id;
        $questionBank->question_type = $request->question_type;
        $questionBank->pl_code = $request->programming_language;
        $questionBank->question = $request->question;
        $questionBank->passage = $request->passage;
        $questionBank->marks = $request->marks;
        $questionBank->is_active = 1;
        $questionBank->slug = time() . str::random(5);
        $questionBank->batch = trim($request->batch);
        $questionBank->created_at = Carbon::now();
        $questionBank->save();

        if ($request->question_type == 1) {
            foreach ($request->mcq as $mcq) {
                MCQ::insert([
                    "question_id" => $questionBank->id,
                    "mc" => $mcq,
                    "created_at" => Carbon::now(),
                ]);
            }
            QuestionBank::where('id', $questionBank->id)->update([
                "answer" => $request->answer[0]
            ]);
        }

        if ($request->question_type == 2) {
            QuestionBank::where('id', $questionBank->id)->update([
                "answer" => $request->editor1
            ]);
        }

        if ($request->question_type == 3) {
            foreach ($request->mcq as $mcq) {
                MCQ::insert([
                    "question_id" => $questionBank->id,
                    "mc" => $mcq,
                    "created_at" => Carbon::now(),
                ]);
            }
            if ($request->hasFile('question_file')) {
                $fileName = time() . str::random(5) . '.' . $request->question_file->extension();
                $request->question_file->move('question_file/', $fileName);
            }
            QuestionBank::where('id', $questionBank->id)->update([
                "answer" => $request->answer[0],
                "question_file" => "question_file/" . $fileName
            ]);
        }

        if ($request->question_type == 4) {
            if ($request->hasFile('question_file')) {
                $fileName = time() . str::random(5) . '.' . $request->question_file->extension();
                $request->question_file->move('question_file/', $fileName);
            }
            QuestionBank::where('id', $questionBank->id)->update([
                "answer" => $request->editor1,
                "question_file" => "question_file/" . $fileName
            ]);
        }

        return redirect('/create/assesment/thirdstep');
    }

    public function saveAssesmentThirdStep(Request $request)
    {
        $inserted_assesment_id = session('last_assesment_inserted_id');
        $assementInfo = Assesment::where('id', $inserted_assesment_id)->first();

        if (isset($request->time)) {
            $time_for_questions = 0;
            $i = 0;
            foreach ($request->time as $time) {
                QuestionBank::where('assesment_id', $assementInfo->id)->where('slug', $request->question_slug[$i])->update([
                    'time' => $time
                ]);
                $time_for_questions = $time_for_questions + $time;
                $i++;
            }
            Assesment::where('id', $inserted_assesment_id)->update([
                'total_mins' => $assementInfo->total_mins + $time_for_questions,
                'updated_at' => Carbon::now()
            ]);
        }

        if (isset($request->marks)) {
            $marks_for_questions = 0;
            foreach ($request->marks as $mark) {
                $marks_for_questions = $marks_for_questions + $mark;
            }
            Assesment::where('id', $inserted_assesment_id)->update([
                'total_marks' => $assementInfo->total_marks + $marks_for_questions,
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect('/create/assesment/laststep');
    }

    public function createAssesmentLastStep()
    {
        $inserted_assesment_id = session('last_assesment_inserted_id');
        $assementInfo = Assesment::where('id', $inserted_assesment_id)->first();
        $assesment_tests = DB::table('assesment_tests')
            ->join('tests', 'assesment_tests.test_id', '=', 'tests.id')
            ->select('tests.*')
            ->where('assesment_tests.assesment_id', $inserted_assesment_id)
            ->get();
        $assesment_questions = QuestionBank::where('assesment_id', $inserted_assesment_id)->get();

        AssessmentOwner::insert([
            'user_id' => $assementInfo->user_id,
            'assessment_id' => $assementInfo->id,
            'status' => 1, // Users Own Assessment;
            'slug' => time(). str::random(5),
            'created_at' => Carbon::now()
        ]);

        return view('backend.assesment.createLastStep', compact('assementInfo', 'assesment_tests', 'assesment_questions'));
    }

    public function saveAssesmentLastStep(Request $request)
    {
        $request->session()->forget('last_assesment_inserted_id');
        Toastr::success('Assesment has been Created', 'Success');
        return redirect("/home");
    }

    public function sendLinkInEmail(Request $request)
    {

        $howManyEmail = count($request->email);
        $currentBalance = User::where('id', Auth::user()->id)->first()->current_limit;
        $expiry_date = User::where('id', Auth::user()->id)->first()->expire_date;

        if ($currentBalance >= $howManyEmail && $expiry_date > date('Y-m-d')) {
            foreach ($request->email as $email) {
                $data = array();
                // $data['name'] = $request->name;
                $data['email'] = $email;
                $data['message'] = $request->message;
                $data['company_name'] = Auth::user()->company_name != '' ? Auth::user()->company_name : Auth::user()->name;
                $data['assesment_slug'] = $request->link;
                $slug = time() . str::random(10);
                $data['slug'] = $slug;

                Candidate::insert([
                    'user_id' => Auth::user()->id,
                    // 'name' => $request->name,
                    'email' => $email,
                    'assesment_slug' => $request->link,
                    'slug' => $slug,
                    'invited_on' => Carbon::now(),
                    'created_at' => Carbon::now(),
                ]);

                Mail::to(trim($email))->send(new SendLink($data));
                User::where('id', Auth::user()->id)->decrement('current_limit', 1);
            }

            return response()->json(['data' => 1]);
        } else {
            return response()->json(['data' => 0]);
        }
    }

    public function createAssesmentLink(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['company_name'] = Auth::user()->name;
        $data['assesment_slug'] = $request->link;
        $slug = time() . str::random(10);
        $data['slug'] = $slug;

        Candidate::insert([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'assesment_slug' => $request->link,
            'slug' => $slug,
            'invited_on' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        $link = "Link has been copied to the clipboard : ";
        $link = "https://testtalents.com/take/assesment/" . $request->link . "/" . $request->email . "/" . $slug;
        return response()->json(['success' => 'Email Send Successfully.', 'link' => $link]);
    }

    public function searchJobRole(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('job_roles')
                ->where('title', 'LIKE', "%$search%")
                ->limit(20)
                ->get();
        }
        return response()->json($data);
    }

    public function softDeleteAssesment($slug)
    {
        Assesment::where('slug', $slug)->update([
            'is_deleted' => 1,
        ]);
        return response()->json(['success' => 'Product saved successfully.']);
    }
}
