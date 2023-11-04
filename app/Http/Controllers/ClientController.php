<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Assesment;
use App\QuestionBank;
use App\AssesmentTest;
use App\CandidateResult;
use App\TestQuestion;
use Carbon\Carbon;
use App\Candidate;
use App\Mail\FinishAssessmentMail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class ClientController extends Controller
{
    public function takeAssesment($slug, $email, $candidateSlug)
    {
        if (Candidate::where('email', $email)->where('assesment_slug', $slug)->where('slug', $candidateSlug)->exists() && Candidate::where('email', $email)->where('assesment_slug', $slug)->where('slug', $candidateSlug)->first()->assesment_status == 1) {

            $candidateInfo = Candidate::where('email', $email)->where('assesment_slug', $slug)->where('slug', $candidateSlug)->first();
            if($candidateInfo){
                if($candidateInfo->number_of_trial >= 2){
                    return view('backend.client.alreadyGiven');
                }
                else{
                    $client_email = $email;
                    $assesment_info = DB::table('assesments')
                        ->join('users', 'assesments.user_id', '=', 'users.id')
                        ->select('assesments.*', 'users.name as username', 'users.company_name')
                        ->where('slug', $slug)
                        ->first();

                    $assesment_tests_count = AssesmentTest::where('assesment_slug', $slug)->count();
                    $assesment_questions_count = QuestionBank::where('assesment_id', $assesment_info->id)->count();
                    return view('backend.client.takeAssesment', compact('assesment_info', 'assesment_tests_count', 'assesment_questions_count', 'client_email', 'candidateSlug'));
                }
            }
            else{
                return view('backend.client.alreadyGiven');
            }

        } else {
            return view('backend.client.alreadyGiven');
        }
    }

    public function startAssesment(Request $request)
    {

        $candAntiCheatInfo = Candidate::where('slug', $request->candidate_slug)->first();
        $candAntiCheatInfo->name = $request->candidate_name;
        $candAntiCheatInfo->save();

        // anti cheating check start
        if (!is_numeric(strpos($candAntiCheatInfo->device_used, $request->device_used))) {
            if ($candAntiCheatInfo->device_used == null) {
                Candidate::where('slug', $request->candidate_slug)->update([
                    'device_used' => $request->device_used
                ]);
            } else {
                Candidate::where('slug', $request->candidate_slug)->update([
                    'device_used' => $candAntiCheatInfo->device_used . ", " . $request->device_used
                ]);
            }
        }

        if (!is_numeric(strpos($candAntiCheatInfo->os_used, $request->os_used))) {
            if ($candAntiCheatInfo->os_used == null) {
                Candidate::where('slug', $request->candidate_slug)->update([
                    'os_used' => $request->os_used
                ]);
            } else {
                Candidate::where('slug', $request->candidate_slug)->update([
                    'os_used' => $candAntiCheatInfo->os_used . ", " . $request->os_used
                ]);
            }
        }

        if (!is_numeric(strpos($candAntiCheatInfo->browser_used, $request->browser_used))) {
            if ($candAntiCheatInfo->browser_used == null) {
                Candidate::where('slug', $request->candidate_slug)->update([
                    'browser_used' => $request->browser_used
                ]);
            } else {
                Candidate::where('slug', $request->candidate_slug)->update([
                    'browser_used' => $candAntiCheatInfo->browser_used . ", " . $request->browser_used
                ]);
            }
        }

        if (!is_numeric(strpos($candAntiCheatInfo->location, $request->browser_used))) {
            if ($candAntiCheatInfo->location == null) {
                if ($request->location != '') {
                    Candidate::where('slug', $request->candidate_slug)->update([
                        'location' => $request->location
                    ]);
                }
            } else {
                if ($request->location != '') {
                    Candidate::where('slug', $request->candidate_slug)->update([
                        'location' => $candAntiCheatInfo->location . " || " . $request->location
                    ]);
                }
            }
        }

        if (!is_numeric(strpos($candAntiCheatInfo->ip_address, $request->ip_address))) {
            if ($candAntiCheatInfo->ip_address == null) {
                if ($request->ip_address != '') {
                    Candidate::where('slug', $request->candidate_slug)->update([
                        'ip_address' => $request->ip_address
                    ]);
                }
            } else {
                if ($request->ip_address != '') {
                    Candidate::where('slug', $request->candidate_slug)->update([
                        'ip_address' => $candAntiCheatInfo->ip_address . ", " . $request->ip_address,
                        'ip_address_status' => "Different"
                    ]);
                }
            }
        }

        Candidate::where('email', $request->client_email)->where('assesment_slug', $request->assesment_slug)->where('slug', $request->candidate_slug)->increment('number_of_trial');
        // anti cheating check end


        $assesment_slug = $request->assesment_slug;
        $client_email = $request->client_email;
        $candidate_slug = $request->candidate_slug;

        $countNumberOfTests = AssesmentTest::where('assesment_slug', $request->assesment_slug)->count();
        if ($countNumberOfTests > 0) {
            $test_running_now = 0;
            $assesment_test = AssesmentTest::where('assesment_slug', $request->assesment_slug)->skip($test_running_now)->take(1)->first();

            $candidateInfo = Candidate::where('slug', $candidate_slug)->first();
            if (CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', $assesment_test->test_slug)->exists()) {
                $assesment_test = AssesmentTest::where('assesment_slug', $assesment_slug)->skip($test_running_now)->take(1)->first();
                $countCandidateResult = CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', $assesment_test->test_slug)->count();
                $countTestQuestion = TestQuestion::where('test_slug', $assesment_test->test_slug)->count();
                if ($countCandidateResult == $countTestQuestion) {
                    return $this->preparingRemainingExam($assesment_slug,$candidate_slug,$client_email,$test_running_now);//prev approach
                } else {

                    $alreadyAnsweredQuestion = CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', $assesment_test->test_slug)->get();
                    $idOfAlreadyAnsweredQuestion = array();
                    $index = 0;
                    foreach($alreadyAnsweredQuestion as $item){
                        $idOfAlreadyAnsweredQuestion[$index] = $item->question_id;
                        $index++;
                    }

                    $questionsOfThisTest = DB::table('question_banks')
                        ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                        ->select('question_banks.*')
                        ->where('test_questions.test_id', $assesment_test->test_id)
                        ->whereNotIn('question_banks.id', $idOfAlreadyAnsweredQuestion)
                        ->get();

                    $actualQuestionsOfThisTest = DB::table('question_banks')
                        ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                        ->select('question_banks.*')
                        ->where('test_questions.test_id', $assesment_test->test_id)
                        ->count();

                    return view('backend.client.test', compact('questionsOfThisTest', 'actualQuestionsOfThisTest', 'countNumberOfTests', 'test_running_now', 'assesment_test', 'assesment_slug', 'client_email', 'candidate_slug'));
                }
            } else {

                $questionsOfThisTestCount = DB::table('question_banks')
                    ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                    ->select('question_banks.*')
                    ->where('test_questions.test_id', $assesment_test->test_id)
                    ->count();

                if ($questionsOfThisTestCount == 0) {
                    $nextTestUrl = "/next/test/".$assesment_slug."/".$candidate_slug."/".$test_running_now;
                    return redirect($nextTestUrl);
                } else {
                    $questionsOfThisTest = DB::table('question_banks')
                        ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                        ->select('question_banks.*')
                        ->where('test_questions.test_id', $assesment_test->test_id)
                        ->get();

                    $actualQuestionsOfThisTest = count($questionsOfThisTest);

                    return view('backend.client.test', compact('questionsOfThisTest', 'actualQuestionsOfThisTest', 'countNumberOfTests', 'test_running_now', 'assesment_test', 'assesment_slug', 'client_email', 'candidate_slug'));
                }
            }
        } else {
            $assesInfo = Assesment::where('slug', $request->assesment_slug)->first();
            if ($questionsOfThisTest = DB::table('question_banks')->where('assesment_id', $assesInfo->id)->count() > 0) {

                $candidateInfo = Candidate::where('slug', $candidate_slug)->first();
                $alreadySubmittedQuestions = CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', null)->get();
                $questionsWillNotAppearID = array();
                $index = 0;
                foreach ($alreadySubmittedQuestions as $alreadySubmittedQuestion) {
                    $questionsWillNotAppearID[$index] = $alreadySubmittedQuestion->question_id;
                    $index++;
                }

                $countQuestionsOfThisTest = DB::table('question_banks')
                    ->select('question_banks.*')
                    ->where('assesment_id', $assesInfo->id)
                    ->whereNotIn('id', $questionsWillNotAppearID)
                    ->count();

                if ($countQuestionsOfThisTest > 0) {
                    $questionsOfThisTest = DB::table('question_banks')
                        ->select('question_banks.*')
                        ->where('assesment_id', $assesInfo->id)
                        ->whereNotIn('id', $questionsWillNotAppearID)
                        ->get();

                    $actualQuestionsOfThisTest = DB::table('question_banks')
                        ->select('question_banks.*')
                        ->where('assesment_id', $assesInfo->id)
                        ->count();

                    return view('backend.client.question', compact('questionsOfThisTest', 'actualQuestionsOfThisTest', 'countNumberOfTests', 'assesment_slug', 'client_email', 'candidate_slug'));
                } else {
                    $finishTestUrl = "/finish/test/".$assesment_slug."/".$candidate_slug;
                    return redirect($finishTestUrl);
                }
            } else {
                $finishTestUrl = "/finish/test/".$assesment_slug."/".$candidate_slug;
                return redirect($finishTestUrl);
            }
        }
    }

    public function nextTest($assesment_slug,$candidate_slug,$test_running_now)
    {

        $client_email = Candidate::where('slug', $candidate_slug)->first()->email;
        $countNumberOfTests = AssesmentTest::where('assesment_slug', $assesment_slug)->count();

        $value = $test_running_now;
        $value++;
        $test_running_now++;

        if ($value >= $countNumberOfTests) {

            $assesInfo = Assesment::where('slug', $assesment_slug)->first();
            if (DB::table('question_banks')->where('assesment_id', $assesInfo->id)->count() > 0) {
                $assesInfo = Assesment::where('slug', $assesment_slug)->first();

                $candidateInfo = Candidate::where('slug', $candidate_slug)->first();
                $alreadySubmittedQuestions = CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', null)->get();
                $questionsWillNotAppearID = array();
                $index = 0;
                foreach ($alreadySubmittedQuestions as $alreadySubmittedQuestion) {
                    $questionsWillNotAppearID[$index] = $alreadySubmittedQuestion->question_id;
                    $index++;
                }

                $countQuestionsOfThisTest = DB::table('question_banks')
                    ->select('question_banks.*')
                    ->where('assesment_id', $assesInfo->id)
                    ->whereNotIn('id', $questionsWillNotAppearID)
                    ->count();

                if ($countQuestionsOfThisTest > 0) {
                    $questionsOfThisTest = DB::table('question_banks')
                        ->select('question_banks.*')
                        ->where('assesment_id', $assesInfo->id)
                        ->whereNotIn('id', $questionsWillNotAppearID)
                        ->get();

                    $actualQuestionsOfThisTest = DB::table('question_banks')
                        ->select('question_banks.*')
                        ->where('assesment_id', $assesInfo->id)
                        ->count();

                    return view('backend.client.question', compact('questionsOfThisTest', 'actualQuestionsOfThisTest', 'countNumberOfTests', 'assesment_slug', 'client_email', 'candidate_slug'));
                } else {
                    $finishTestUrl = "/finish/test/".$assesment_slug."/".$candidate_slug;
                    return redirect($finishTestUrl);
                }
            } else {
                $finishTestUrl = "/finish/test/".$assesment_slug."/".$candidate_slug;
                return redirect($finishTestUrl);
            }
        }
        else {
            $assesment_test = AssesmentTest::where('assesment_slug', $assesment_slug)->skip($value)->take(1)->first();

            $candidateInfo = Candidate::where('slug', $candidate_slug)->first();
            if (CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', $assesment_test->test_slug)->exists()) {

                $assesment_test = AssesmentTest::where('assesment_slug', $assesment_slug)->skip($value)->take(1)->first();
                $countCandidateResult = CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', $assesment_test->test_slug)->count();
                $countTestQuestion = TestQuestion::where('test_slug', $assesment_test->test_slug)->count();
                if ($countCandidateResult == $countTestQuestion) {
                    $test_running_now = $value;
                    return $this->preparingRemainingExam($assesment_slug,$candidate_slug,$client_email,$test_running_now);
                } else {

                    $alreadySubmittedQuestions = CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', $assesment_test->test_slug)->get();
                    $questionsWillNotAppearID = array();
                    $index = 0;
                    foreach ($alreadySubmittedQuestions as $alreadySubmittedQuestion) {
                        $questionsWillNotAppearID[$index] = $alreadySubmittedQuestion->question_id;
                        $index++;
                    }

                    $questionsOfThisTest = DB::table('question_banks')
                        ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                        ->select('question_banks.*')
                        ->where('test_questions.test_id', $assesment_test->test_id)
                        ->whereNotIn('question_banks.id', $questionsWillNotAppearID)
                        ->get();

                    $actualQuestionsOfThisTest = DB::table('question_banks')
                        ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                        ->select('question_banks.*')
                        ->where('test_questions.test_id', $assesment_test->test_id)
                        ->count();

                    return view('backend.client.test', compact('questionsOfThisTest', 'actualQuestionsOfThisTest', 'countNumberOfTests', 'assesment_test', 'assesment_slug', 'client_email', 'candidate_slug', 'test_running_now'));
                }
            } else {

                $questionsOfThisTest = DB::table('question_banks')
                    ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                    ->select('question_banks.*')
                    ->where('test_questions.test_id', $assesment_test->test_id)
                    ->get();

                $actualQuestionsOfThisTest = count($questionsOfThisTest);

                return view('backend.client.test', compact('questionsOfThisTest', 'actualQuestionsOfThisTest', 'countNumberOfTests', 'assesment_test', 'assesment_slug', 'client_email', 'candidate_slug', 'test_running_now'));
            }
        }
    }

    public function preparingRemainingExam($assesment_slug,$candidate_slug,$client_email,$test_running_now)
    {
        $countNumberOfTests = AssesmentTest::where('assesment_slug', $assesment_slug)->count();

        $value = $test_running_now;

        $candidateInfo = Candidate::where('slug', $candidate_slug)->first();
        $value++;

        if ($value >= $countNumberOfTests) {
            $assesInfo = Assesment::where('slug', $assesment_slug)->first();
            if ($questionsOfThisTest = DB::table('question_banks')->where('assesment_id', $assesInfo->id)->count() > 0) {
                $assesInfo = Assesment::where('slug', $assesment_slug)->first();
                $alreadySubmittedQuestions = CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', null)->get();
                $questionsWillNotAppearID = array();
                $index = 0;
                foreach ($alreadySubmittedQuestions as $alreadySubmittedQuestion) {
                    $questionsWillNotAppearID[$index] = $alreadySubmittedQuestion->question_id;
                    $index++;
                }

                $countQuestionsOfThisTest = DB::table('question_banks')
                    ->select('question_banks.*')
                    ->where('assesment_id', $assesInfo->id)
                    ->whereNotIn('id',$questionsWillNotAppearID)
                    ->count();

                if ($countQuestionsOfThisTest > 0) {
                    $questionsOfThisTest = DB::table('question_banks')
                        ->select('question_banks.*')
                        ->where('assesment_id', $assesInfo->id)
                        ->whereNotIn('id',$questionsWillNotAppearID)
                        ->get();

                    $actualQuestionsOfThisTest = DB::table('question_banks')
                        ->select('question_banks.*')
                        ->where('assesment_id', $assesInfo->id)
                        ->count();

                    return view('backend.client.question', compact('questionsOfThisTest', 'actualQuestionsOfThisTest', 'countNumberOfTests', 'assesment_slug', 'client_email', 'candidate_slug'));
                } else {
                    $finishTestUrl = "/finish/test/".$assesment_slug."/".$candidate_slug;
                    return redirect($finishTestUrl);
                }
            } else {
                $finishTestUrl = "/finish/test/".$assesment_slug."/".$candidate_slug;
                return redirect($finishTestUrl);
            }
        } else {
            $assesment_test = AssesmentTest::where('assesment_slug', $assesment_slug)->skip($value)->take(1)->first();

            if (CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', $assesment_test->test_slug)->exists()) {

                $assesment_test = AssesmentTest::where('assesment_slug', $assesment_slug)->skip($value)->take(1)->first();
                $countCandidateResult = CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', $assesment_test->test_slug)->count();
                $countTestQuestion = TestQuestion::where('test_slug', $assesment_test->test_slug)->count();
                if ($countCandidateResult == $countTestQuestion) {
                    return $this->preparingRemainingExam($assesment_slug,$candidate_slug,$client_email,$value);
                } else {

                    $alreadySubmittedQuestions = CandidateResult::where('candidate_id', $candidateInfo->id)->where('email', $client_email)->where('assesment_slug', $assesment_slug)->where('test_slug', $assesment_test->test_slug)->get();
                    $questionsWillNotAppearID = array();
                    $index = 0;
                    foreach ($alreadySubmittedQuestions as $alreadySubmittedQuestion) {
                        $questionsWillNotAppearID[$index] = $alreadySubmittedQuestion->question_id;
                        $index++;
                    }

                    $countQuestionsOfThisTest = DB::table('question_banks')
                    ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                    ->select('question_banks.*')
                    ->where('test_questions.test_id', $assesment_test->test_id)
                    ->whereNotIn('question_banks.id',$questionsWillNotAppearID)
                    ->count();


                    if ($countQuestionsOfThisTest > 0) {
                        $questionsOfThisTest = DB::table('question_banks')
                            ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                            ->select('question_banks.*')
                            ->where('test_questions.test_id', $assesment_test->test_id)
                            ->whereNotIn('question_banks.id',$questionsWillNotAppearID)
                            ->get();

                        $actualQuestionsOfThisTest = DB::table('question_banks')
                            ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                            ->select('question_banks.*')
                            ->where('test_questions.test_id', $assesment_test->test_id)
                            ->count();

                        return view('backend.client.test', compact('questionsOfThisTest', 'actualQuestionsOfThisTest', 'countNumberOfTests', 'assesment_test', 'assesment_slug', 'client_email', 'candidate_slug', 'test_running_now'));
                    }
                    else{
                        $nextTestUrl = "/next/test/".$assesment_slug."/".$candidate_slug."/".$test_running_now;
                        return redirect($nextTestUrl);
                    }

                }
            } else {
                $questionsOfThisTest = DB::table('question_banks')
                    ->join('test_questions', 'question_banks.id', '=', 'test_questions.question_id')
                    ->select('question_banks.*')
                    ->where('test_questions.test_id', $assesment_test->test_id)
                    ->get();

                $actualQuestionsOfThisTest = count($questionsOfThisTest);

                return view('backend.client.test', compact('questionsOfThisTest', 'actualQuestionsOfThisTest', 'countNumberOfTests', 'assesment_test', 'assesment_slug', 'client_email', 'candidate_slug', 'test_running_now'));
            }
        }
    }

    public function finishTest($assesment_slug,$candidate_slug)
    {
        Candidate::where('slug', $candidate_slug)->update([
            'assesment_status' => 0,
            'updated_at' => Carbon::now()
        ]);

        // send email to assessment creator start
        $assessmentInfo = Assesment::where('slug',$assesment_slug)->first();
        $candidateInfo = Candidate::where('slug', $candidate_slug)->first();
        $userInfo = User::find($assessmentInfo->user_id);

        $data = array();
        $data['candidate_name'] = $candidateInfo->name;
        $data['assessment_creator_email'] = $userInfo->email;
        $data['assessment_creator_name'] = $userInfo->name;

        try {
            Mail::to(trim($userInfo->email))->send(new FinishAssessmentMail($data));
            return view('backend.client.finishAssesment');
        }
        catch(\Exception $e) {
            return view('backend.client.finishAssesment');
        }
        // send email to assessment creator end

    }
}
