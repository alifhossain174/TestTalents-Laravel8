@extends('backend.master')

@section('content')

    <form action="{{url('save/assesment/laststep')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- backend navigation start-->
        <section>
            <div class="backend_navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="navigation_title">
                                <h3>Review Assesment (Step-4)</h3>
                                <b>Review your assessment.</b>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="navigation_item pt-2">
                                <ul>
                                    <li class="active">
                                        <button type="submit" style="cursor: pointer">Finish Assesment Creation <i class="fas fa-arrow-right"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- backend navigation end-->


        <!-- question content start-->
        <section>
            <div class="single_assesment_content mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="assesment_details">

                                <div class="row pb-5 pt-3">
                                    <div class="col-lg-3 text-center">
                                        <a class="btn btn-dark text-white" style="cursor:default">Step 1 : Set Title & Role</a> <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="col-lg-3 text-center">
                                        <a class="btn btn-dark text-white" style="cursor:default">Step 2 : Select Test</a> <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn btn-dark text-white" style="cursor:default">Step 3 : Add Question</a> <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn text-white" style="background: #226679;cursor:default">Step 4 : Review & Configure</a>
                                    </div>
                                </div>

                                <section>
                                    <div class="test" style="background: transparent">
                                        <div class="test_content">
                                            <div class="row wow fadeInUp" data-wow-duration="1.2s" id="question_coloumn">
                                                <div class="col-lg-12">
                                                    <h5 class="mb-3"><b>Assesment Tests :</b></h5>
                                                    <table class="table table-striped">
                                                        <thead>
                                                          <tr>
                                                            <th scope="col">SL</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Tests</th>
                                                            <th scope="col">Time</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1; ?>
                                                            @foreach ($assesment_tests as $test)
                                                            <tr>
                                                                <th scope="row">{{$i++}}</th>
                                                                <td>
                                                                    @if($test->test_level == 1)
                                                                        <i class="fas fa-bars"></i> Easy
                                                                    @elseif($test->test_level == 2)
                                                                        <i class="fas fa-chart-bar"></i> Intermediate
                                                                    @elseif($test->test_level == 3)
                                                                        <i class="fas fa-qrcode"></i> Expert
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @php
                                                                    if(strlen($test->test_name) > 65){
                                                                        echo substr($test->test_name,0,64)."...";
                                                                    }
                                                                    else{
                                                                        echo $test->test_name;
                                                                    }
                                                                    @endphp
                                                                </td>
                                                                <td><i class="far fa-clock"></i> {{$test->test_time}} min</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                    <h5 class="mb-3 mt-5"><b>Assesment Questions :</b></h5>
                                                    <table class="table table-striped">
                                                        <thead>
                                                          <tr>
                                                            <th scope="col">SL</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Question</th>
                                                            <th scope="col">Time</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=1; ?>
                                                            @foreach ($assesment_questions as $question)
                                                            <tr>
                                                                <th scope="row">{{$i++}}</th>
                                                                <td>
                                                                    @if($question->question_type == 1)
                                                                    <i class="fas fa-check"></i> MCQ
                                                                    @elseif($question->question_type == 2)
                                                                    <i class="far fa-edit"></i> Open Ended
                                                                    @elseif($question->question_type == 3)
                                                                    <i class="fas fa-check"></i> MCQ +
                                                                    <i class="far fa-file-alt"></i> File
                                                                    @elseif($question->question_type == 4)
                                                                    <i class="far fa-edit"></i> Open Ended +
                                                                    <i class="far fa-file-alt"></i> File
                                                                    @else
                                                                    <i class="fas fa-laptop-code"></i> Coding
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @php
                                                                    if(strlen($question->question) > 90){
                                                                        echo substr($question->question,0,90)."...";
                                                                    }
                                                                    else{
                                                                        echo $question->question;
                                                                    }
                                                                    @endphp
                                                                </td>
                                                                <td><i class="far fa-clock"></i> {{$question->time}} min</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- question content end-->

    </form>
@endsection
