@extends('backend.master')

@section("header_css")
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
    <link rel="stylesheet" href="{{url('codeMirror')}}/css/codemirror.css">
    <link rel="stylesheet" href="{{url('codeMirror')}}/css/themes/material.css">
    <style>
        .CodeMirror {
            width: 600px !important;
        }
    </style>
@endsection

@section("header_js")
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script src="{{url('codeMirror')}}/js/codemirror.js"></script>
    <script src="{{url('codeMirror')}}/js/xml.js"></script>
    <script src="{{url('codeMirror')}}/js/php.js"></script>
    <script src="{{url('codeMirror')}}/js/javascript.js"></script>
    <script src="{{url('codeMirror')}}/js/python.js"></script>
    <script src="{{url('codeMirror')}}/js/addons/closetag.js"></script>
    <script src="{{url('codeMirror')}}/js/addons/closebrackets.js"></script>
@endsection

@section('content')
<!-- backend navigation start-->
<form action="{{url('save/marks')}}" method="POST" enctype="multipart/form-data">
@csrf
<section>
    <div class="backend_navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="navigation_title">

                        <h3 class="mb-2">{{$candidateInfo->name}}</h3>
                        <b><i class="far fa-envelope"></i> Email : </b> {{$candidateInfo->email}}
                        <b class="ml-2"><i class="far fa-clock"></i> Invited On : </b>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $candidateInfo->invited_on)->format('d M, Y h:i A')}}

                    </div>
                </div>
                <div class="col-lg-4 text-right">
                    <div class="navigation_item pt-3">
                        <ul>
                            <li class="active">
                                <button type="submit" style="cursor: pointer"><i class="fas fa-check"></i> Submit Grades</button>
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
<section style="min-height: 100vh">
    <div class="assesment_content mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 table-responsive">

                    <table class="table table-striped mt-5 w-100">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col" style="width: 20%;">Questions</th>
                                <th scope="col">Answers</th>
                                <th scope="col" style="width: 10%; text-align:center">Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{url('save/marks')}}" method="POST" enctype="multipart/form-data">

                            <?php $sl = 1;?>
                            @if(count($results) <= 0)
                                <tr>
                                    <th class="text-center text-danger" colspan="4">
                                        No answered has submitted yet
                                    </th>
                                </tr>
                            @else
                                @foreach ($results as $index => $result)
                                <tr>
                                    <th scope="row">
                                        {{ $sl }}
                                        @csrf
                                        <input type="hidden" name="candidate_slug" value="{{$candidateInfo->slug}}">
                                        <input type="hidden" name="question_id[]" value="{{$result->question_id}}">
                                    </th>
                                    <td scope="row">
                                        @if(($result->question_type == 1 || $result->question_type == 3) && $result->question_created_by != Auth::user()->id)
                                            <i style="font-weight: 600;">Protecting Test Integrity : Questions and Answers Hidden from Employers</i>
                                        @else
                                            {{$result->question}}
                                        @endif

                                        @php
                                            $audioRecordings = App\CandidateRecording::where('candidate_id',$candidateInfo->id)->where('assesment_id',App\Assesment::where('slug',$candidateInfo->assesment_slug)->first()->id)->where('question_id',$result->question_id)->get();
                                        @endphp

                                        @if($audioRecordings)
                                        <br>
                                        <span class="d-block mt-3" style="font-weight: 600">Recording (During Exam) : </span>
                                            @php
                                                $recordingsArray = array();
                                                foreach ($audioRecordings as $recording){
                                                    array_push($recordingsArray, $recording->file_name);
                                                }
                                            @endphp

                                            <div id="music_list_{{$index}}">
                                                <audio controls=""></audio>
                                                <small>Recordings are in autoplay mode</small><br>
                                                <span id="playlistSerial_{{$index}}"></span>
                                                <i class="fas fa-step-forward" onclick="return next{{$index}}()" style="cursor: pointer"></i>
                                            </div>

                                            <script>

                                                var index<?php echo $index;?> = 0;
                                                var files<?php echo $index;?> = <?php echo json_encode($recordingsArray); ?>;
                                                document.querySelector("#playlistSerial_"+<?php echo $index;?>).innerHTML = "Playing 1/"+files<?php echo $index;?>.length;
                                                var music_player<?php echo $index;?> = document.querySelector("#music_list_"+<?php echo $index;?>+" audio");

                                                function next<?php echo $index;?>() {
                                                    if (Number(index<?php echo $index;?>) == (Number(files<?php echo $index;?>.length)-1)) {
                                                        //index<?php echo $index;?> = 0; //if you want to play again from start
                                                        return false;
                                                    } else {
                                                        index<?php echo $index;?>++;
                                                    }
                                                    music_player<?php echo $index;?>.src = "/recordings/"+files<?php echo $index;?>[index<?php echo $index;?>];
                                                    music_player<?php echo $index;?>.play();
                                                    document.querySelector("#playlistSerial_"+<?php echo $index;?>).innerHTML = "Playing "+Number(index<?php echo $index;?>+1)+"/"+files<?php echo $index;?>.length;
                                                }


                                                if (music_player<?php echo $index;?> === null) {
                                                    console.log("Playlist Player does not exists ...");
                                                } else {
                                                    music_player<?php echo $index;?>.src = "/recordings/"+files<?php echo $index;?>[index<?php echo $index;?>];
                                                    music_player<?php echo $index;?>.addEventListener('ended', next<?php echo $index;?>, false)
                                                }
                                            </script>
                                        @endif

                                        <span class="d-block mt-3" style="font-weight: 600">Webcam Capture (During Exam) : </span>
                                        <?php
                                            if(isset($webcamImagesArray[$sl-1])){
                                                echo  "<div class='row'><div class='col-lg-12 mt-2'><img class='image' id='image".$sl."' data-image='".url("webcamImages")."/".$webcamImagesArray[$sl-1]."' style='width: 300px'></div></div>";
                                            }
                                        ?>

                                    </td>
                                    <td>
                                        @if($result->question_type == 1 || $result->question_type == 3)

                                            @if($result->question_created_by == Auth::user()->id)
                                                Given Answer : {{$result->answer}} <br>
                                                Right Answer :
                                                @php
                                                    $rightAnswer = App\QuestionBank::where('id',$result->question_id)->first()->answer;
                                                    $mcq = App\MCQ::where('question_id',$result->question_id)->get();
                                                    if(isset($mcq[$rightAnswer-1]->mc)){
                                                        echo $mcq[$rightAnswer-1]->mc;
                                                    }
                                                @endphp
                                            @else
                                                <i style="font-weight: 600;">Responses are kept confidential for ethical reasons and evaluations are performed by artificial intelligence.</i>
                                            @endif

                                        @elseif($result->question_type == 2 || $result->question_type == 4)
                                            <textarea class="answer" id="answer_{{$sl}}" name="answer[]">{!! $result->answer !!}</textarea>
                                        @else
                                            <input style="width: 600px" class="form-control" name="programming_language" id="programming_language_{{$sl}}" value="{{$result->pl_code}}" readonly>
                                            <textarea style="width: 600px" class="code_answer" id="code_answer_{{$sl}}" name="answer[]">{!! $result->answer !!}</textarea>
                                            <a style="width: 600px" class="btn btn-sm btn-success rounded mt-1 mb-2 text-white" onclick="runMyCode({{$sl}})">
                                                <img src="{{url('images')}}/loader3.gif" style="height:17px;width:17px;margin-right:5px;display:none" id="loading{{$sl}}"><b>Execute</b>
                                            </a>
                                            <label style="width: 600px" class="d-block">See the Results Here :</label>
                                            <div id="result{{$sl}}" style="width: 600px; min-height: 100px; background:rgb(213, 213, 213); border-radius: 5px; padding: 5px 10px;font-weight:400 !important">

                                            </div>
                                        @endif

                                    </td>
                                    <td style="text-align: center">

                                        @php
                                            $evaluatorMarks = 0;

                                            $marksByEvaluator = App\CandidateResult::select('marks')->where([
                                                ['evaluator_id', '=', NULL],
                                                ['candidate_id', '=', $result->candidate_id],
                                                ['assesment_id', '=', $result->assesment_id],
                                                ['question_id', '=', $result->question_id]
                                            ])->first();

                                            if(!$marksByEvaluator){
                                                $marksByEvaluator = App\CandidateResult::select('marks')->where([
                                                    ['evaluator_id', '=', Auth::user()->id],
                                                    ['candidate_id', '=', $result->candidate_id],
                                                    ['assesment_id', '=', $result->assesment_id],
                                                    ['question_id', '=', $result->question_id]
                                                ])->first();
                                            }

                                            $evaluatorMarks = $marksByEvaluator ? $marksByEvaluator->marks : 0;
                                        @endphp

                                        <input type="number" step=".01" max="{{App\QuestionBank::where('id',$result->question_id)->first()->marks}}" @if($result->question_type == 1 || $result->question_type == 3) value="{{$result->marks}}" @else value="{{$evaluatorMarks}}" @endif name="marks[]" class="form-control p-1 text-center" @if($result->question_type == 1 || $result->question_type == 3) readonly @endif>
                                        out of <b>{{App\QuestionBank::where('id',$result->question_id)->first()->marks}}</b>
                                    </td>
                                </tr>
                                @php
                                    $sl++;
                                @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>
</form>
<!-- assesment content end-->


@endsection


@section('footer_js')

<script type="text/javascript">

    let options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.25
    };
    var numItems = $('.image').length;

    $(document).ready(function() {
        let callback = (entries, observer) => {
        entries.forEach(entry => {
                if (entry.isIntersecting && entry.target.className === 'image') {
                    let imageUrl = entry.target.getAttribute('data-image')
                    if (imageUrl) {
                        entry.target.src = imageUrl;
                        // observer.unobserver(entry.target);
                    }
                }
            });
        }

        let observer = new IntersectionObserver(callback, options);
        observer.observe(document.querySelector('#image1'));

        for(var i = 1; i <= numItems; i++){
            observer.observe(document.querySelector('#image'+i));
        }
    });






    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.editQuestion', function () {
        var slug = $(this).data('id');
        $('#saveBtn').val("edit-user");
        $('#ajaxModel2').modal('show');
        $('#link').val(slug);
        $("#productForm")[0].reset();
        $("#saveBtn").html("<i class='far fa-paper-plane'></i> Send Link");
    });

    function runMyCode(id){
        $('#loading'+id).css('display','inline-block')
        $('#result'+id).html('');
        var data = $('#code_answer_'+id).text();
        var pl_code = $('#programming_language_'+id).val();

        if(pl_code == null){
            toastr.error('Please Select Programming Language');
            $('#loading'+id).css('display','none');
            return false;
        }
        if(data == ''){
            toastr.error('Please Write Some Code');
            $('#loading'+id).css('display','none');
            return false;
        }

        $.ajax({
            data: {data:data, pl_code:pl_code},
            url: '{{ url('/compile/code') }}',
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#result'+id).html(data.output.replace('jdoodle', 'index'));
                $('#loading'+id).css('display','none')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    $(function(){
        $('.answer').each(function(e){
            CKEDITOR.replace(this.id, {
                filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        });
    });

    var textareas = document.querySelectorAll(".code_answer");
    for (var i = 0; i < textareas.length; i++) {
        editor = CodeMirror.fromTextArea(textareas[i], {
            mode: "javascript",
            theme: "material",
            lineNumbers: true,
            autoCloseTags: true,
            autoCloseBrackets: true
        });
        editor.setSize("100%", "200");
    }

</script>

<script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
{!! Toastr::message() !!}

@endsection
