<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <style>
        .logo {
            width: 100%;
            margin-bottom: 10px;
        }

        .assessment_info {
            width: 100%;
            margin-bottom: 20px;
        }

        #watermark {
            position: absolute;
            top: 35%;
            left: 5%;
            transform: translate(-50%, -50%);
            font-size: 180px;
            z-index: -99;
            transform: rotate(-50deg);
            color: rgba(169, 169, 169, 0.5)
        }

        table.candidate_info tr td {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="logo">
        <table style="width: 100%">
            <tr>
                <td>
                    <h2 style="font-size: 26px; color: #2d3436; display:inline-block; border-bottom: 2px solid black">
                        REPORT CARD</h2>
                </td>
                <td style="text-align: right"><img src="{{ public_path('frontend_assets/images/logo2.jpg') }}"
                        style="width: 200px;"></td>
            </tr>
        </table>
    </div>

    @php
        $totalMarks = 0;
        $marksPercentage = 0;
        foreach ($candidateResult as $value) {
            $totalMarks += $value->marks;
        }
        $marksPercentage = ($totalMarks / $assessmentInfo->total_marks) * 100;
    @endphp

    <div class="candidate">
        <h3 style="text-align: center">Candidate Information</h3>
        <table style="width: 100%">
            <tr>
                <td style="text-align:left; width: 50%">
                    <table style="width: 100%" class="candidate_info">
                        <tr>
                            <td style="text-align: left; width:90px"><b>Invited On </b></td>
                            <td>:
                                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $candidateInfo->invited_on)->format('jS F, Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><b>No of Trial </b></td>
                            <td>: {{ $candidateInfo->number_of_trial }} times</td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><b>Invitation </b></td>
                            <td>: By Email</td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><b>Email </b></td>
                            <td>: {{ $candidateInfo->email }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><b>Status </b></td>
                            <td>
                                @if ($candidateInfo->stage == 0)
                                    : Not Checked
                                @elseif($candidateInfo->stage == 2)
                                    : Not Evaluated
                                @else
                                    : Evaluated
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><b>Score </b></td>
                            <td>

                                @php
                                    $averageScore = 0;
                                    foreach ($evaluatorsEvaluations as $value) {
                                        $marksOfThisAssesment = App\Assesment::where('slug', $candidateInfo->assesment_slug)->first()->total_marks;
                                        $totalGainedMarks = App\CandidateResult::where('candidate_id', $candidateInfo->id)
                                            ->where('assesment_slug', $candidateInfo->assesment_slug)
                                            ->where('evaluator_id', $value->evaluator_id)
                                            ->sum('marks');
                                        $averageScore = $averageScore + ($totalGainedMarks / $marksOfThisAssesment) * 100;
                                    }
                                    // echo number_format($averageScore/count($evaluatorsEvaluations), 2)."%";
                                @endphp

                                {{-- @if (count($evaluatorsEvaluations) >= 1)
                                    @if ($averageScore / count($evaluatorsEvaluations) > 80)
                                    : <b style="color: green">{{number_format($averageScore/count($evaluatorsEvaluations), 2)}}%</b> (Good)
                                    @elseif (($averageScore/count($evaluatorsEvaluations)) > 60 && ($averageScore/count($evaluatorsEvaluations)) < 79)
                                    : <b style="color: blue">{{ number_format($averageScore/count($evaluatorsEvaluations), 2)}}%</b> (Average)
                                    @else
                                    : <b style="color: red">{{number_format($averageScore/count($evaluatorsEvaluations), 2)}}%</b> (Poor)
                                    @endif
                                @endif --}}

                                :<b>{{ count($evaluatorsEvaluations) > 0 ? number_format($averageScore / count($evaluatorsEvaluations), 2) : 0 }}%</b>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="text-align:right; width: 50%; vertical-align:top">
                    @if (count($webcamImages) > 0)
                        <div class="row testimonial_slider">
                            <div class="col-lg-12 mt-2">
                                @if (isset($webcamImages[0]))
                                    <img src="{{ public_path('webcamImages') }}/{{ $webcamImages[0]->file_name }}"
                                        style="width: 170px; border: 3px solid gray; border-radius: 4px">
                                @endif
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>


    <div class="assessment_info" style="margin-top: 30px;">
        <table style="width: 100%; border-collapse: collapse;" border="1">
            <thead style="background: #1D4354;">
                <tr>
                    <td colspan="4"
                        style="text-align: center; padding: 3px 0px; color: white; font-size: 16px; border-color: black">
                        Assessment Information</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%; text-align:left; padding: 4px 5px; font-size: 14px"><b>Assessment : </b>
                    </td>
                    <td colspan="3" style="padding: 4px 5px; font-size: 14px"> {{ $assessmentInfo->title }}</td>
                </tr>
                <tr>
                    <td style="width: 15%; text-align:left;padding: 4px 5px;font-size: 14px"><b>Job Role : </b></td>
                    {{-- <td style="padding: 4px 5px;font-size: 14px"> {{DB::table('job_roles')->where('id',$assessmentInfo->job_role)->first()->title}}</td> --}}
                    <td style="padding: 4px 5px;font-size: 14px"> {{ $assessmentInfo->job_role }}</td>
                    <td style="width: 20%; text-align:left;padding: 4px 5px;font-size: 14px "><b>Total Marks : </b></td>
                    <td style="width: 10%;padding: 4px 5px;font-size: 14px"> {{ $assessmentInfo->total_marks }}</td>
                </tr>
                <tr>
                    <td style="width: 15%; text-align:left;padding: 4px 5px ;font-size: 14px"><b>Time : </b></td>
                    <td style="padding: 4px 5px;font-size: 14px"> {{ $assessmentInfo->total_mins }} minutes</td>
                    <td style="width: 20%; text-align:left;padding: 4px 5px;font-size: 14px "><b>Obtained Marks : </b>
                    </td>
                    <td style="width: 10%; padding: 4px 5px;font-size: 14px"> <b>{{ $totalMarks }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="assessment_info">
        <table style="width: 100%;border-collapse: collapse;" border="1">
            <thead style="background: #1D4354;">
                <tr>
                    <td colspan="6"
                        style="text-align: center; padding: 3px 0px; color: white; font-size: 16px; border-color: black">
                        Anti Cheating Status</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 12%; text-align:right; padding: 4px 5px; font-size: 14px"><b>OS : </b></td>
                    <td style="padding: 4px 5px; font-size: 14px"> {{ $candidateInfo->os_used }}</td>
                    <td style="width: 20%; text-align:right;padding: 4px 5px; font-size: 14px "><b>IP Address : </b>
                    </td>
                    <td style="padding: 4px 5px; font-size: 14px"> {{ $candidateInfo->ip_address }}</td>
                    {{-- <td style="width: 15%; text-align:right;padding: 4px 5px; font-size: 14px "><b>Cursor : </b></td>
                    <td style="padding: 4px 5px; font-size: 14px"> Exact</td> --}}
                    <td style="width: 15%; text-align:right;padding: 4px 5px; font-size: 14px "><b>Same IP : </b></td>
                    <td style="padding: 4px 5px; font-size: 14px"> <span
                            style="color: red; padding-right: 5px;">NO</span></td>
                </tr>
                <tr>
                    <td style="width: 12%; text-align:right; padding: 4px 5px; font-size: 14px"><b>Device : </b></td>
                    <td style="padding: 4px 5px; font-size: 14px"> {{ $candidateInfo->device_used }}</td>
                    <td style="width: 20%; text-align:right;padding: 4px 5px; font-size: 14px "><b>Voice Recorded : </b>
                    </td>
                    <td style="padding: 4px 5px; font-size: 14px">
                        @if ($candidateInfo->sound_taken > 0)
                            <span style="color: green; padding-right: 5px;">Yes</span>
                            ({{ $candidateInfo->sound_taken }} Clips)
                        @else
                            <span style="color: red; padding-right: 5px;">NO</span>
                        @endif
                    </td>
                    <td style="width: 15%; text-align:right;padding: 4px 5px; font-size: 14px "><b>Full Screen : </b>
                    </td>
                    <td style="padding: 4px 5px; font-size: 14px">
                        @php
                            $assessmentInfo = App\Assesment::where('slug', $candidateInfo->assesment_slug)->first();
                            $noOftestAndQuestion = App\AssesmentTest::where('assesment_slug', $candidateInfo->assesment_slug)->count();
                            if (App\QuestionBank::where('assesment_id', $assessmentInfo->id)->count() > 0) {
                                $noOftestAndQuestion++;
                            }
                        @endphp
                        @if ($noOftestAndQuestion > $candidateInfo->full_screen_status)
                            <span style="color: red; padding-right: 5px;">NO</span>
                        @else
                            <span style="color: green; padding-right: 5px;">Yes</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width: 2%; text-align:right;padding: 4px 5px; font-size: 14px "><b>Browser : </b></td>
                    <td style="padding: 4px 5px; font-size: 14px">{{ $candidateInfo->browser_used }}</td>
                    <td style="width: 20%; text-align:right;padding: 4px 5px; font-size: 14px "><b>Webcam Enabled : </b>
                    </td>
                    <td style="padding: 4px 5px; font-size: 14px" colspan="3">
                        @if ($candidateInfo->webcam > 0)
                            <span style="color: green; padding-right: 5px;">Yes</span> ({{ $candidateInfo->webcam }}
                            Images)
                        @else
                            <span style="color: red; padding-right: 5px;">NO</span>
                        @endif
                    </td>
                </tr>
                {{-- <tr>
                    <td style="text-align:right; padding: 4px 5px; font-size: 14px"><b>Location : </b></td>
                    <td colspan="5" style="padding: 4px 5px; font-size: 14px">{{$candidateInfo->location}}</td>
                </tr> --}}
            </tbody>
        </table>
    </div>

    <div class="assessment_info">
        <table style="width: 100%;border-collapse: collapse;" border="1">
            <thead style="background: #1D4354;">
                <tr>
                    <td
                        style="text-align: center; padding: 3px 0px; color: white; font-size: 16px; border-color: black">
                        SL</td>
                    <td
                        style="text-align: center; padding: 3px 0px; color: white; font-size: 16px; border-color: black">
                        Tests & Questions</td>
                    <td
                        style="text-align: center; padding: 3px 0px; color: white; font-size: 16px; border-color: black">
                        Score</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $sl = 1;
                @endphp
                @if (count($givenTests) > 0)
                    <tr>
                        <td colspan="3" style="width: 5%; text-align:center; font-size: 15px"><b>Tests</b></td>
                    </tr>
                    @foreach ($givenTests as $test)
                        <tr>
                            <td style="width: 5%; text-align:center; font-size: 14px"><b>{{ $sl++ }} </b></td>
                            <td style="padding: 4px 5px; font-size: 14px">{{ $test->test_name }}</td>
                            <td style="width: 12%; text-align:center; padding: 4px 5px; font-size: 14px">
                                @php
                                    $testPercentage = 0;
                                    foreach ($evaluatorsEvaluations as $value) {
                                        $testInfo = App\Test::where('id', $test->test_id)->first();
                                        $testMarks = App\CandidateResult::where('test_id', $test->test_id)
                                            ->where('candidate_id', $candidateInfo->id)
                                            ->where('evaluator_id', $value->evaluator_id)
                                            ->where('assesment_slug', $candidateInfo->assesment_slug)
                                            ->sum('marks');
                                        $testPercentage = $testPercentage + ($testMarks / $testInfo->total_marks) * 100;
                                    }
                                    echo '<b>' . number_format($testPercentage / count($evaluatorsEvaluations), 2) . '%</b>';
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if (count($givenQuestions) > 0)
                    <tr>
                        <td colspan="3" style="width: 5%; text-align:center; font-size: 15px"><b>Questions</b></td>
                    </tr>
                    @foreach ($givenQuestions as $givenQuestion)
                        <tr>
                            <td style="width: 5%; text-align:center; font-size: 14px"><b>{{ $sl++ }} </b></td>
                            <td style="padding: 4px 5px; font-size: 14px">{!! $givenQuestion->question !!}</td>
                            <td style="width: 12%; text-align:center; padding: 4px 5px; font-size: 14px">
                                @php
                                    $questionPercentage = 0;
                                    foreach ($evaluatorsEvaluations as $value) {
                                        $questionInfo = App\QuestionBank::where('id', $givenQuestion->question_id)->first();
                                        $questionMarks = App\CandidateResult::where('question_id', $givenQuestion->question_id)
                                            ->where('candidate_id', $candidateInfo->id)
                                            ->where('evaluator_id', $value->evaluator_id)
                                            ->where('assesment_slug', $candidateInfo->assesment_slug)
                                            ->sum('marks');
                                        $questionPercentage = $questionPercentage + ($questionMarks / $questionInfo->marks) * 100;
                                    }

                                    echo '<b>' . number_format($questionPercentage / count($evaluatorsEvaluations), 2) . '%</b>';
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                @endif

                <tr>
                    <td colspan="2" style="width: 5%; text-align:right; font-size: 14px"><b>Average Score : </b></td>
                    <td style="width: 12%; text-align:center; padding: 4px 5px; font-size: 14px">
                        <b>
                            @php
                                $averageScore = 0;

                                foreach ($evaluatorsEvaluations as $value) {
                                    $marksOfThisAssesment = App\Assesment::where('slug', $candidateInfo->assesment_slug)->first()->total_marks;
                                    $totalGainedMarks = App\CandidateResult::where('candidate_id', $candidateInfo->id)
                                        ->where('assesment_slug', $candidateInfo->assesment_slug)
                                        ->where('evaluator_id', $value->evaluator_id)
                                        ->sum('marks');
                                    $averageScore = $averageScore + ($totalGainedMarks / $marksOfThisAssesment) * 100;
                                }

                                if (count($evaluatorsEvaluations) >= 1) {
                                    echo number_format($averageScore / count($evaluatorsEvaluations), 2) . '%';
                                }
                            @endphp
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <small style="color: #132b36">*This Report is computer generated and therefore does not require any
        signature.</small><br>
    <small style="color: #132b36">*Average Score can be the average of scores provided by multiple evaluators.</small>

    {{-- <div>
        <table style="width: 100%;margin-top : 100px">
            <tr>
                <td style="text-align: right">
                    <img src="{{ public_path('frontend_assets/images/signature_monir.png') }}" style="width: 150px;"><br>
                    <b style="border-top: 1px solid black; margin-right: 10px">Authorized By</b>
                </td>
            </tr>
        </table>
    </div> --}}

    <div id="watermark">TestTalents</div>

</body>

</html>
