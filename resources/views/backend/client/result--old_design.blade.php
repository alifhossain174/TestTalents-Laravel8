@extends('backend.master')

@section("header_css")
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/slick.css">
    <style>
        .testimonial_slider .slick-dots{
            text-align: center
        }
        .testimonial_slider .slick-dots li {
            display: inline-block;
            height: 10px;
            width: 10px;
            border-radius: 50%;
            margin: 0px 7px;
            background-color: #1D4354;
            cursor: pointer;
            transition: all .2s linear;
        }

        .testimonial_slider .slick-dots li.slick-active {
            background-color: #fb9631;
        }

        .testimonial_slider .slick-dots li button {
            display: none;
        }
    </style>
@endsection

@section('content')

    <!-- backend navigation start-->
    <section>
        <div class="backend_navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="navigation_title">
                            <h3><u>Evaluation Report of</u></h3>
                            <b>{{$candidateInfo->email}}</b>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="navigation_item pt-3">
                            <ul>
                                <li class="active">
                                    <a href="{{url('print/result')}}/{{$candidateInfo->slug}}"><i class="fas fa-download"></i> Report</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- backend navigation end-->


    <!-- assesment content start-->
    <section>
        <div class="single_assesment_content mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="assesment_details">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h5><strong>Assesment : </strong> {{App\Assesment::where('slug',$candidateInfo->assesment_slug)->first()->title}}</h5>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <img src="{{url('frontend_assets')}}/images/star.png" class="img-fluid" style="height: 20px;width: 20px;">
                                    <img src="{{url('frontend_assets')}}/images/star.png" class="img-fluid" style="height: 20px;width: 20px;">
                                    <img src="{{url('frontend_assets')}}/images/star.png" class="img-fluid" style="height: 20px;width: 20px;">
                                    <img src="{{url('frontend_assets')}}/images/star.png" class="img-fluid" style="height: 20px;width: 20px;">
                                    <img src="{{url('frontend_assets')}}/images/star.png" class="img-fluid" style="height: 20px;width: 20px;">
                                </div>
                            </div>
                            <div class="row border-bottom pb-4">
                                <div class="col-lg-4 mt-5 border-right">
                                    <b>Invited :</b>
                                    <p>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $candidateInfo->invited_on)->format('d M, Y h:i A')}}</p>

                                    <br>

                                    <b>Status :</b>
                                    <p>
                                        @php
                                            if($candidateInfo->assesment_status == 1){
                                                echo "Not Finished Yet";
                                            }
                                            else{
                                                echo "Finished on ".Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $candidateInfo->updated_at)->format('d M, Y h:i A');
                                            }
                                        @endphp
                                    </p>

                                    <br>

                                    <b>Source :</b>
                                    <p>Invitation by Email</p>

                                    <br>

                                    <b>Stage</b>

                                    @if($candidateInfo->stage == 0)
                                    <p class="alert alert-danger pt-1 pb-1 mt-2 pl-2">Not Checked</p>
                                    @elseif($candidateInfo->stage == 2)
                                    <p class="alert alert-warning pt-1 pb-1 mt-2 pl-2">Not Evaluated</p>
                                    @else
                                    <p class="alert alert-success pt-1 pb-1 mt-2 pl-2">Evaluated</p>
                                    @endif

                                </div>
                                <div class="col-lg-4 mt-5 border-right">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <b class="d-block mb-2">Tests & Questions</b>
                                        </div>
                                        <div class="col-lg-3 text-center">
                                            <b class="d-block mb-2"><i class="fas fa-star-half-alt"></i></b>
                                        </div>

                                        @foreach ($givenTests as $givenTest)
                                        <div class="col-lg-9">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-2">{{$givenTest->test_name}}</p>
                                        </div>
                                        <div class="col-lg-3 text-left">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-2">
                                                @php
                                                    $testInfo = App\Test::where('id',$givenTest->test_id)->first();
                                                    $testMarks = App\CandidateResult::where('test_id',$givenTest->test_id)->where('candidate_id',$candidateInfo->id)->where('assesment_slug',$candidateInfo->assesment_slug)->where('evaluator_id', Auth::user()->id)->sum('marks');
                                                    $testPercentage = ($testMarks/$testInfo->total_marks)*100;
                                                    echo "<b>".number_format($testPercentage,2)."%</b>";
                                                @endphp
                                            </p>
                                        </div>
                                        @endforeach

                                        @foreach ($givenQuestions as $givenQuestion)
                                        <div class="col-lg-9">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-2">{{$givenQuestion->question}}</p>
                                        </div>
                                        <div class="col-lg-3 text-left">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-2">
                                                @php
                                                    $questionInfo = App\QuestionBank::where('id',$givenQuestion->question_id)->first();
                                                    $questionMarks = App\CandidateResult::where('question_id',$givenQuestion->question_id)->where('candidate_id',$candidateInfo->id)->where('assesment_slug',$candidateInfo->assesment_slug)->where('evaluator_id', Auth::user()->id)->first();
                                                    $questionPercentage = ($questionMarks->marks/$questionInfo->marks)*100;
                                                    echo "<b>".number_format($questionPercentage,2)."%</b>";
                                                @endphp
                                            </p>
                                        </div>
                                        @endforeach

                                    </div>

                                    <div class="row mt-3 mb-2 border-top border-bottom pt-2 pb-2">
                                        <div class="col-lg-9">
                                            <p style="text-shadow: 5px 5px 10px rgb(204, 204, 204);"><b>Average Score</b></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <p style="text-shadow: 5px 5px 10px rgb(204, 204, 204);">
                                                <b>
                                                    @php
                                                        $marksOfThisAssesment = App\Assesment::where('slug',$candidateInfo->assesment_slug)->first()->total_marks;
                                                        $totalGainedMarks = App\CandidateResult::where('candidate_id', $candidateInfo->id)->where('assesment_slug',$candidateInfo->assesment_slug)->where('evaluator_id', Auth::user()->id)->sum('marks');
                                                        $averageScore = ($totalGainedMarks/$marksOfThisAssesment)*100;
                                                        echo number_format($averageScore,2)."%";
                                                    @endphp
                                                </b>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4 mt-5">
                                    <div class="row">
                                        <div class="col-lg-10"><b class="d-block mb-2">Anti Cheating Monitor</b></div>
                                        <div class="col-lg-2 text-center"><b class="d-block mb-2"><i class="fas fa-skull-crossbones"></i></b></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">Browser : </p>
                                        </div>
                                        <div class="col-lg-6 text-right pr-0">
                                            <p class="mb-1">
                                                @if($candidateInfo->browser_used != null)
                                                <a class="btn btn-sm btn-info text-white pt-0 pb-0">{{$candidateInfo->browser_used}}</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">Device Used : </p>
                                        </div>
                                        <div class="col-lg-6 text-right pr-0">
                                            <p class="mb-1">
                                                @if($candidateInfo->device_used != null)
                                                <a class="btn btn-sm btn-info text-white pt-0 pb-0">{{$candidateInfo->device_used}}</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">Operating System : </p>
                                        </div>
                                        <div class="col-lg-6 text-right pr-0">
                                            <p class="mb-1">
                                                @if($candidateInfo->os_used != null)
                                                <a class="btn btn-sm btn-info text-white pt-0 pb-0">{{$candidateInfo->os_used}}</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-lg-4">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">Location : </p>
                                        </div>
                                        <div class="col-lg-8 text-right pr-0">
                                            <p class="mb-1" style="overflow: auto;">
                                                @if($candidateInfo->location != null)
                                                <a class="btn btn-sm btn-danger text-white pt-0 pb-0">{{$candidateInfo->location}}</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">IP Address : </p>
                                        </div>
                                        <div class="col-lg-6 text-right pr-0">
                                            <p class="mb-1">
                                                @if($candidateInfo->ip_address != null)
                                                <a class="btn btn-sm btn-info text-white pt-0 pb-0">{{$candidateInfo->ip_address}}</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">Same IP or Different : </p>
                                        </div>
                                        <div class="col-lg-4 text-right pr-0">
                                            <p class="mb-1">
                                                @if($candidateInfo->ip_address_status != null)
                                                <a class="btn btn-sm btn-danger text-white pt-0 pb-0">{{$candidateInfo->ip_address_status}}</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">Sound Taken : </p>
                                        </div>
                                        <div class="col-lg-2 text-right pr-0">
                                            <p class="mb-1">
                                                @if($candidateInfo->sound_taken == 0)
                                                <a class="btn btn-sm btn-danger text-white pt-0 pb-0">No</a>
                                                @else
                                                <a class="btn btn-sm btn-success text-white pt-0 pb-0">Yes</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">Webcam Enabled : </p>
                                        </div>
                                        <div class="col-lg-2 text-right pr-0">
                                            <p class="mb-1">
                                                <a class="btn btn-sm btn-success text-white pt-0 pb-0">Yes</a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">Full Screen Always Active : </p>
                                        </div>
                                        <div class="col-lg-2 text-right pr-0">
                                            @php
                                                $assessmentInfo = App\Assesment::where('slug',$candidateInfo->assesment_slug)->first();
                                                $noOftestAndQuestion = App\AssesmentTest::where('assesment_slug',$candidateInfo->assesment_slug)->count();
                                                if(App\QuestionBank::where('assesment_id',$assessmentInfo->id)->count() > 0){
                                                    $noOftestAndQuestion++;
                                                }
                                            @endphp
                                            <p class="mb-1">
                                                @if($noOftestAndQuestion > $candidateInfo->full_screen_status)
                                                <a class="btn btn-sm btn-danger text-white pt-0 pb-0">No</a>
                                                @else
                                                <a class="btn btn-sm btn-success text-white pt-0 pb-0">Yes</a>
                                                @endif
                                            </p>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-1">Mouse Always inside Tab : </p>
                                        </div>
                                        <div class="col-lg-2 text-right pr-0">
                                            <p class="mb-1">
                                                @if($candidateInfo->mouse_always_inside_tab == 1)
                                                    <a class="btn btn-sm btn-success text-white pt-0 pb-0">Yes</a>
                                                @else
                                                    <a class="btn btn-sm btn-danger text-white pt-0 pb-0">No</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    {{-- @if(count($webcamImages) > 0)
                                    <div class="row testimonial_slider">
                                        @foreach ($webcamImages as $webcamImage)
                                        <div class="col-lg-12 mt-2">
                                            <img src="{{url('webcamImages')}}/{{$webcamImage->file_name}}" class="img-fluid w-100">
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif --}}

                                </div>
                            </div>






                            @if(count($evaluatorsEvaluations) > 0)
                            <div class="row pt-4 mb-4">
                                <div class="col-lg-12">
                                    <b class="mb-3 d-block"><u>Evaluator's Evaluations</u></b>

                                    @foreach ($evaluatorsEvaluations as $evaluation)
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <div style="width: 100%; padding: 20px 20px 20px 20px; box-shadow: 1px 1px 15px gray; border-radius: 5px; background: floralwhite;">
                                                <p style="font-family: Helvetica, sans-serif;">
                                                    <span style="font-weight: 600">Evaluator Name :</span> <span style="font-weight: 600; color: #1D4354">{{$evaluation->username}} </span>
                                                </p>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-lg-9">
                                                        <b class="d-block mb-2">Tests & Questions</b>
                                                    </div>
                                                    <div class="col-lg-3 text-right">
                                                        <b class="d-block mb-2"><i class="fas fa-star-half-alt"></i></b>
                                                    </div>

                                                    @php
                                                        $givenTestsByEvaluator = DB::table('candidate_results')
                                                                            ->join('tests','candidate_results.test_id','=','tests.id')
                                                                            ->select('candidate_results.*','tests.test_name')
                                                                            ->where('candidate_results.test_id','!=',null)
                                                                            ->where('evaluator_id', $evaluation->evaluator_id)
                                                                            ->where('candidate_results.candidate_id',$candidateInfo->id)
                                                                            ->where('candidate_results.assesment_slug',$candidateInfo->assesment_slug)
                                                                            ->groupBy('candidate_results.test_id')
                                                                            ->get();

                                                        $givenQuestionsByEvaluator = DB::table('candidate_results')
                                                                            ->join('question_banks','candidate_results.question_id','=','question_banks.id')
                                                                            ->select('candidate_results.*','question_banks.question')
                                                                            ->where('candidate_results.test_id',null)
                                                                            ->where('evaluator_id', $evaluation->evaluator_id)
                                                                            ->where('candidate_results.candidate_id',$candidateInfo->id)
                                                                            ->where('candidate_results.assesment_slug',$candidateInfo->assesment_slug)
                                                                            ->get();
                                                    @endphp

                                                    @foreach ($givenTestsByEvaluator as $givenTest)
                                                    <div class="col-lg-9">
                                                        <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-2">{{$givenTest->test_name}}</p>
                                                    </div>
                                                    <div class="col-lg-3 text-right">
                                                        <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-2 text-right">
                                                            @php
                                                                $testInfo = App\Test::where('id',$givenTest->test_id)->first();
                                                                $testMarks = App\CandidateResult::where('test_id',$givenTest->test_id)->where('candidate_id',$candidateInfo->id)->where('assesment_slug',$candidateInfo->assesment_slug)->where('evaluator_id', $evaluation->evaluator_id)->sum('marks');
                                                                $testPercentage = ($testMarks/$testInfo->total_marks)*100;
                                                                echo "<b>".number_format($testPercentage,2)."%</b>";
                                                            @endphp
                                                        </p>
                                                    </div>
                                                    @endforeach

                                                    @foreach ($givenQuestionsByEvaluator as $givenQuestion)
                                                    <div class="col-lg-9">
                                                        <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-2">{{$givenQuestion->question}}</p>
                                                    </div>
                                                    <div class="col-lg-3 text-left">
                                                        <p style="text-shadow: 2px 2px 5px rgb(204, 204, 204);" class="mb-2 text-right">
                                                            @php
                                                                $questionInfo = App\QuestionBank::where('id',$givenQuestion->question_id)->first();
                                                                $questionMarks = App\CandidateResult::where('question_id',$givenQuestion->question_id)->where('candidate_id',$candidateInfo->id)->where('assesment_slug',$candidateInfo->assesment_slug)->where('evaluator_id', $evaluation->evaluator_id)->first();
                                                                $questionPercentage = ($questionMarks->marks/$questionInfo->marks)*100;
                                                                echo "<b>".number_format($questionPercentage,2)."%</b>";
                                                            @endphp
                                                        </p>
                                                    </div>
                                                    @endforeach

                                                </div>

                                                <div class="row mt-3 border-top pt-2">
                                                    <div class="col-lg-9">
                                                        <p style="text-shadow: 5px 5px 10px rgb(204, 204, 204);"><b>Average Score</b></p>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <p style="text-shadow: 5px 5px 10px rgb(204, 204, 204);" class="text-right">
                                                            <b>
                                                                @php
                                                                    $marksOfThisAssesment = App\Assesment::where('slug',$candidateInfo->assesment_slug)->first()->total_marks;
                                                                    $totalGainedMarks = App\CandidateResult::where('candidate_id', $candidateInfo->id)->where('assesment_slug',$candidateInfo->assesment_slug)->where('evaluator_id', $evaluation->evaluator_id)->sum('marks');
                                                                    $averageScore = ($totalGainedMarks/$marksOfThisAssesment)*100;
                                                                    echo number_format($averageScore,2)."%";
                                                                @endphp
                                                            </b>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            @endif






                            <div class="row pt-4">
                                <div class="col-lg-12">
                                    <b class="mb-3 d-block"><u>Testimonials</u></b>

                                    @foreach ($candidateTestimonials as $testimonial)
                                    <p style="font-family: Helvetica, sans-serif;">
                                        <span style="font-weight: 600; color: #1D4354">{{$testimonial->referee_name}} </span><img title="Verified" style="width: 20px" src="{{url('frontend_assets/images/verified.png')}}"><br>
                                        <span style="font-size: 14px; color: #7a8f82">{{$testimonial->email}}</span><br>
                                        <span style="font-family: 'Brush Script MT', cursive;">{{$testimonial->reply}}</span>
                                    </p>
                                    <hr>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- assesment content end-->
@endsection

@section('footer_js')
    <script src="{{url('frontend_assets')}}/js/slick.min.js"></script>
    <script>
        $('.testimonial_slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            // autoplay: true,
            // autoplaySpeed: 5000,
        });
    //Testimonial Slider End
    </script>
@endsection

