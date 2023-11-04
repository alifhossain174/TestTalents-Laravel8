@extends('backend.client.master')

@section('header_css')
    <link rel="stylesheet" href="{{ url('codeMirror') }}/css/codemirror.css">
    <link rel="stylesheet" href="{{ url('codeMirror') }}/css/themes/material.css">
    <link rel="stylesheet" href="{{ url('frontend_assets') }}/css/toastr.min.css">
    <link href="{{ url('select2Autocomplete') }}/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .container {
            width: 92% !important;
            max-width: 92% !important;
        }

        label.mcq_set {
            padding: 8px;
            display: block;
            border: 1px solid #d6d6d6;
            margin-bottom: 12px;
            border-radius: 5px;
            transition: all .1s linear;
            font-family: 'Roboto', sans-serif !important;
            cursor: pointer;
        }

        label.mcq_set:hover {
            border-color: #1D4354;
            box-shadow: 5px 5px 5px rgb(172, 172, 172);
        }

        label.mcq_set input {
            margin-right: 3px;
            cursor: pointer;
        }

        label.pl_selection {
            font-family: 'Roboto', sans-serif !important;
            color: #1D4354;
            font-size: 15px;
            font-weight: 500;
        }

        span.testTime {
            font-family: 'Roboto', sans-serif !important;
            font-size: 18px;
            font-weight: 500;
            color: #1D4354;
        }

        #question_numbering_on_top {
            font-family: 'Roboto', sans-serif !important;
            font-size: 18px;
            font-weight: 500;
            color: #1D4354;
        }

        h4.question_title {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -o-user-select: none;
            font-family: 'Roboto', sans-serif !important;
            font-size: 18px;
            font-weight: 400;
            color: #1e272e
        }

        span.select2-container {
            width: 100% !important;
        }

        .modal-content {
            background: #0E212A;
        }

        .modal-header h5 {
            color: ghostwhite;
            font-family: 'Roboto', sans-serif !important;
        }

        .modal-header button span {
            color: white;
            font-family: 'Roboto', sans-serif !important;
        }

        .modal-body {
            background: white;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Roboto', sans-serif !important;
        }

        .modal-footer {
            background: white;
            font-family: 'Roboto', sans-serif !important;
        }

    </style>
@endsection

@section('header_js')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script src="{{ url('codeMirror') }}/js/codemirror.js"></script>
    <script src="{{ url('codeMirror') }}/js/xml.js"></script>
    <script src="{{ url('codeMirror') }}/js/php.js"></script>
    <script src="{{ url('codeMirror') }}/js/javascript.js"></script>
    <script src="{{ url('codeMirror') }}/js/python.js"></script>
    <script src="{{ url('codeMirror') }}/js/addons/closetag.js"></script>
    <script src="{{ url('codeMirror') }}/js/addons/closebrackets.js"></script>
@endsection


@section('content')
    <!-- question content start-->
    <section id="container">
        <div class="single_assesment_content mb-5 mt-5">
            <div class="container bg-white pb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="assesment_details" style="margin-top: 15px; margin-bottom: 10px; background: #FFFAEF">

                            <?php
                            $i = 1;
                            $candidateInfo = App\Candidate::where('slug', $candidate_slug)->first();
                            ?>

                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="mb-3" style="color: #1D4354;font-family: 'Roboto', sans-serif; font-size: 25px;font-weight: 500;">
                                        {{ App\Test::where('slug', $assesment_test->test_slug)->first()->test_name }}
                                    </h3>
                                </div>
                                <div class="col-lg-5"><span class="testTime" id="test_marks"></span></div>
                                <div class="col-lg-4 text-left pl-4">
                                    <h4 id="question_numbering_on_top" class="question_title pt-1" unselectable="on"
                                        onselectstart="return false;" onmousedown="return false;">
                                        {{-- added numbering by js here --}}
                                    </h4>
                                </div>
                                <div class="col-lg-3 text-right">
                                    {{-- <span class="testTime">Time Remaining: <span id="examTime">{{App\Test::where('slug',$assesment_test->test_slug)->first()->test_time}}</span></span> --}}
                                    <span class="testTime">Time Remaining: <span id="examTime"></span></span>
                                </div>
                            </div>

                            @foreach ($questionsOfThisTest as $question)
                                <div class="questionDiv" id="questionsOfTest_{{ $i }}" <?php if ($i <= 1) {
                                        echo "style='display:block;width: 100%'";
                                    } else {
                                        echo "style='display:none;width: 100%'";
                                    } ?>>
                                    <form id="questionForm_{{ $i }}" name="questionForm_{{ $i }}"
                                        class="form-horizontal" autocomplete="off">
                                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                                        <input type="hidden" id="question_type_{{ $i }}"
                                            value="{{ $question->question_type }}">
                                        <input type="hidden" name="test_slug" value="{{ $assesment_test->test_slug }}">
                                        <input type="hidden" name="assesment_slug" id="assesment_slug"
                                            value="{{ $assesment_slug }}">
                                        <input type="hidden" name="client_email" id="client_email"
                                            value="{{ $client_email }}">
                                        <input type="hidden" name="candidate_slug" id="candidate_slug"
                                            value="{{ $candidate_slug }}">
                                        <input type="hidden" name="test_running_now" id="test_running_now"
                                            value="{{ $test_running_now }}">
                                        {{-- capturing webcam image --}}
                                        <div id="my_camera_{{ $i }}" style="display:none"></div>
                                        <input type="hidden" name="webcam" id="image-tag-{{ $i }}">

                                        <div class="row">
                                            <div class="col-lg-5 pl-3 pt-4 pb-3 border-right">

                                                @if ($question->passage != null)
                                                    <h4 class="question_title" unselectable="on"
                                                        onselectstart="return false;" onmousedown="return false;">
                                                        <b>Question Passage : </b>
                                                    </h4>
                                                    {!! $question->passage !!}
                                                    <br>
                                                @endif

                                                @if ($question->passage == null)
                                                    <h4 class="question_title" unselectable="on"
                                                        onselectstart="return false;" onmousedown="return false;">
                                                        <b>Question :</b> {!! $question->question !!}
                                                    </h4>
                                                    <br>
                                                    @php
                                                        if ($question->question_type == 3 || $question->question_type == 4) {

                                                            if ($question->question_file != null) {
                                                                $imageFormats = array("gif", "jpg", "jpeg", "jfif", "pjpeg", "pjp", "png", "svg", "webp");
                                                                $imageName = $question->question_file;
                                                                $imageExtension = explode(".", $imageName);

                                                                if (in_array(end($imageExtension), $imageFormats)){
                                                                    echo "<img src=".url($question->question_file)." class='img-fluid mt-3'>";
                                                                } else {
                                                                    echo "<br><b>File : </b><a href='" . url($question->question_file) . "' download='" . url($question->question_file) . "'>Download</a>";
                                                                }
                                                            }

                                                        }
                                                    @endphp
                                                @endif
                                            </div>

                                            <div class="col-lg-7 pr-3 pt-4 pl-4 pb-3">

                                                <h4 id="question_numbering_{{ $i }}" class="d-none">
                                                    Question
                                                    {{ $i + ($actualQuestionsOfThisTest - count($questionsOfThisTest)) }}
                                                    of {{ $actualQuestionsOfThisTest }}</h4>
                                                <h6 id="question_marks_{{ $i }}" class="d-none">Marks :
                                                    {{ $question->marks }}</h6>

                                                <h6 id="individual_question_time_{{ $i }}"
                                                    class="d-none"> @if ($i == 1 && $candidateInfo->last_question_time_used != 0) {{ round($candidateInfo->last_question_time_used / 60, 2) }} @else {{ $question->time }} @endif </h6>

                                                @if ($question->passage != null)
                                                    <h4 class="question_title" unselectable="on"
                                                        onselectstart="return false;" onmousedown="return false;">
                                                        <b>Question :</b> {!! $question->question !!}
                                                    </h4>
                                                    @php
                                                        if ($question->question_type == 3 || $question->question_type == 4) {
                                                            if ($question->question_file != null) {
                                                                echo "<br><b>File : </b><a href='" . url($question->question_file) . "' download='" . url($question->question_file) . "'>Download</a>";
                                                            }
                                                        }
                                                    @endphp
                                                    <br>
                                                @endif

                                                <?php
                                                    if($question->question_type == 1 || $question->question_type == 3){
                                                        $mcqs = App\MCQ::where('question_id',$question->id)->get();
                                                        foreach($mcqs as $mcq){
                                                ?>
                                                <label for="{{ $mcq->id }}{{ $question->id }}"
                                                    class="mcq_set"><input name='answer[]' type="radio"
                                                        id="{{ $mcq->id }}{{ $question->id }}"
                                                        value="{{ $mcq->mc }}"> {{ $mcq->mc }}</label>

                                                <?php }} elseif($question->question_type == 2 || $question->question_type == 4){ ?>
                                                <textarea id="open_ended_answer_{{ $i }}"
                                                    name="open_ended_answer"></textarea>
                                                <?php } else{ ?>
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label class="pl_selection">Select Programming Language (Required)
                                                            :</label>
                                                        <select name="programming_language"
                                                            id="programming_language_{{ $i }}"
                                                            class="form-control select2">
                                                            @php
                                                                echo App\ProgrammingLanguage::getDropDownList('name');
                                                            @endphp
                                                        </select>
                                                    </div>
                                                </div>
                                                <label class="pl_selection d-block">Write Your Code Here :</label>
                                                <textarea id="code_answer_{{ $i }}" class="code_answer"
                                                    name="code_answer"></textarea>
                                                <a class="btn btn-sm btn-success rounded mt-1 mb-2 text-white"
                                                    onclick="runMyCode({{ $i }})">
                                                    <img src="{{ url('images') }}/loader3.gif"
                                                        style="height:17px;width:17px;margin-right:5px;display:none"
                                                        id="loading{{ $i }}"><b>Execute</b>
                                                </a>
                                                <label class="pl_selection d-block">See the Results Here :</label>
                                                <div id="result{{ $i }}"
                                                    style="width: 100%; min-height: 100px; background:rgb(213, 213, 213); border-radius: 5px; padding: 5px 10px;font-weight:400 !important">

                                                </div>
                                                <?php } ?>

                                                <a href="javascript:void(0)" data-toggle="tooltip"
                                                    onclick="submitQuestionAnswer()" id="nextBtn_{{ $i }}"
                                                    style="color:white;background: #1D4354" class="btn rounded mt-3">Go To
                                                    Next</a>
                                                <img src="{{ url('images') }}/loader3.gif"
                                                    style="height:50;width:50px;margin: 15px 15px;display:none"
                                                    class="loading">
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <?php $i++; ?>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- question content end-->

    <!-- Full Screen Modal start -->
    <div class="modal fade" id="fullScreenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><b>Full Screen Alert !</b></h5>
                    <button type="button" class="close cancelFullScreen" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    We recommend you to complete the assessment in full screen view.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger rounded cancelFullScreen"
                        data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-success rounded" onclick="toggleFullScreen()">Go To Full
                        Screen</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Modal end -->

@endsection

@section('footer_js')

    {{-- code for initializing --}}
    <script src="{{ url('select2Autocomplete') }}/select2.min.js"></script>
    <script type="text/javascript">
        $('.select2').select2({
            placeholder: 'Search for Programming Language'
        });
    </script>

    <script src="{{ url('recordAudioJS') }}/recorder.js"></script>
    <script type='text/javascript'>
        var microphonePermission = true;
        var start = 1;
        let intervalId;
        let idOfUploadAudioChunk;
        var num;
        let timeOfLastQuestion;
    </script>

    <script src="{{ url('webcamCaptureJS') }}/webcam.js"></script>
    <script>
        Webcam.set({
            width: 490,
            height: 390,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
    </script>

    {{-- mouse always in assessment windows status --}}
    <script type='text/javascript'>
        $("body").focus();
        window.addEventListener('blur', function detectNotInFocus() {
            var candidate_slug = $('#questionForm_1').find('input[name="candidate_slug"]').val();
            $.ajax({
                data: {
                    candidate_slug: candidate_slug
                },
                url: '{{ url('/mouse/status/change') }}',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    console.log("Mouse has been removed from Assessment Tab")
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>


    {{-- code that need to run after dom is ready --}}
    <script>
        $(document).ready(function() {
            $('#fullScreenModal').modal('show');
            $("#fullScreenModal").modal({
                backdrop: 'static',
                keyboard: false
            });
            var questionNumbering = $("#question_numbering_1").html();
            $("#question_numbering_on_top").html(questionNumbering);

            var questionMarks = $("#question_marks_1").html();
            $("#test_marks").html(questionMarks);

            startAudioChunkUploadInterval();
            timeManagement();
            uploadUsedTimeOfLastQuestion();
        });

        window.onload = function() {
            startRecording();
            Webcam.attach('#my_camera_1');
        };

        function timeManagement() {
            $('#examTime').css("color", "#1D4354");
            $('#examTime').css("font-weight", "500");
            $('#examTime').css("text-shadow", "none");

            var actualTime = Number($('#individual_question_time_' + start).html());
            num = actualTime * 60;
            intervalId = window.setInterval(function() {
                $('#examTime').html('');
                var hrs = ~~(num / 3600);
                var mins = ~~((num % 3600) / 60);
                var secs = ~~num % 60;
                var ret = "";
                if (hrs > 0) {
                    ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
                }
                ret += "" + mins + ":" + (secs < 10 ? "0" : "");
                ret += "" + secs;
                $('#examTime').html(ret);
                num--;
                if(num < 0){
                    // $('#questionForm_'+start+' input').attr('readonly', 'readonly');
                    $("#nextBtn_"+start).hide();
                    $(".loading").show();
                    clearInterval(intervalId);
                    clearInterval(timeOfLastQuestion);

                    stopUploadAudioByChunk();
                    stopRecording();
                }

                if (num < 10) {
                    if (num % 2 == 0) {
                        $('#examTime').css("text-shadow", "5px 5px 15px gray");
                    } else {
                        $('#examTime').css("text-shadow", "none");
                    }
                    $('#examTime').css("color", "red");
                    $('#examTime').css("font-weight", "600");
                }
            }, 1000);
        }

        function uploadUsedTimeOfLastQuestion() {
            timeOfLastQuestion = window.setInterval(function() {
                var candidate_slug = $('#questionForm_' + start).find('input[name="candidate_slug"]').val();
                $.ajax({
                    data: {
                        timeUsed: num,
                        candidate_slug: candidate_slug
                    },
                    url: '{{ url('/update/used/time') }}',
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        console.log("Time uploaded :" + num);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }, 5000);
        }
    </script>

    {{-- code for audio --}}
    <script>
        function startRecording() {
            var constraints = {
                audio: true,
                video: false
            }
            navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
                audioContext = new AudioContext();
                gumStream = stream;
                input = audioContext.createMediaStreamSource(stream);
                rec = new Recorder(input, {
                    numChannels: 1
                })
                rec.record()
            }).catch(function(err) {
                toastr.error("Audio Recording Is Not Working")
                microphonePermission = false;
            });
        }

        function stopRecording() {
            if (microphonePermission == true) {
                rec.stop();
                gumStream.getAudioTracks()[0].stop();
                rec.exportWAV(createDownloadLink);
            } else {
                submitQuestionAnswerFinal();
            }
        }

        function createDownloadLink(blob) {
            var d = new Date();
            var n = d.getTime();
            var filename = n + Math.floor(Math.random() * 10000000001);
            // var filename = new Date().toISOString() + start;

            var formData = new FormData();
            formData.append("audio_data", blob, filename);

            var candidate_slug = $('#questionForm_' + start).find('input[name="candidate_slug"]').val();
            var assesment_slug = $('#questionForm_' + start).find('input[name="assesment_slug"]').val();
            var question_id = $('#questionForm_' + start).find('input[name="question_id"]').val();
            formData.append("candidate_slug", candidate_slug);
            formData.append("assesment_slug", assesment_slug);
            formData.append("question_id", question_id);

            $.ajax({
                type: 'POST',
                url: '{{ url('/upload/audio') }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log("Audio Uploaded");
                    submitQuestionAnswerFinal();
                }
            });
        }

        function startAudioChunkUploadInterval() {
            idOfUploadAudioChunk = setInterval(uploadAudioChunk, 8000);
        }

        function uploadAudioChunk() {
            stopRecordingByChunk();
            startRecording();
        }

        function stopRecordingByChunk() {
            if (microphonePermission == true) {
                rec.stop();
                gumStream.getAudioTracks()[0].stop();
                rec.exportWAV(createDownloadLinkByChunk);
            }
        }

        function createDownloadLinkByChunk(blob) {
            var d = new Date();
            var n = d.getTime();
            var filename = n + Math.floor(Math.random() * 10000000001);
            // var filename = new Date().toISOString() + start;

            var formData = new FormData();
            formData.append("audio_data", blob, filename);

            var candidate_slug = $('#questionForm_' + start).find('input[name="candidate_slug"]').val();
            var assesment_slug = $('#questionForm_' + start).find('input[name="assesment_slug"]').val();
            var question_id = $('#questionForm_' + start).find('input[name="question_id"]').val();
            formData.append("candidate_slug", candidate_slug);
            formData.append("assesment_slug", assesment_slug);
            formData.append("question_id", question_id);

            $.ajax({
                type: 'POST',
                url: '{{ url('/upload/audio') }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log("Audio Uploaded");
                }
            });

        }

        function stopUploadAudioByChunk() {
            clearInterval(idOfUploadAudioChunk);
        }
    </script>

    {{-- code for compiler --}}
    <script>
        function runMyCode(id) {
            $('#loading' + id).css('display', 'inline-block')
            $('#result' + id).html('');
            var data = $('#code_answer_' + id).text();
            var pl_code = $('#programming_language_' + id).val();

            if (pl_code == null) {
                toastr.error('Please Select Programming Language');
                $('#loading' + id).css('display', 'none');
                return false;
            }
            if (data == '') {
                toastr.error('Please Write Some Code');
                $('#loading' + id).css('display', 'none');
                return false;
            }

            $.ajax({
                data: {
                    data: data,
                    pl_code: pl_code
                },
                url: '{{ url('/compile/code') }}',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#result' + id).html(data.output.replace('jdoodle', 'index'));
                    $('#loading' + id).css('display', 'none')
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    </script>

    {{-- code for fullscreen window --}}
    <script>
        function toggleFullScreen() {
            var doc = window.document;
            var docEl = doc.documentElement;
            var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl
                .webkitRequestFullScreen || docEl.msRequestFullscreen;
            var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc
                .msExitFullscreen;
            if (!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc
                .msFullscreenElement) {
                requestFullScreen.call(docEl);
                $('#fullScreenModal').modal('hide');

                var candidate_slug = $('#questionForm_1').find('input[name="candidate_slug"]').val();
                var fullScreenStatus = 1;
                $.ajax({
                    data: {
                        candidate_slug: candidate_slug,
                        fullScreenStatus: fullScreenStatus
                    },
                    url: '{{ url('/fullscreen/status/change') }}',
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        console.log("Anti Cheating Steps Recorded Successfully")
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            } else {
                cancelFullScreen.call(doc);
                $('#fullScreenModal').modal('hide');
            }
        }

        $('body').on('click', '.cancelFullScreen', function() {
            var candidate_slug = $('#questionForm_1').find('input[name="candidate_slug"]').val();
            var fullScreenStatus = 0;
            $.ajax({
                data: {
                    candidate_slug: candidate_slug,
                    fullScreenStatus: fullScreenStatus
                },
                url: '{{ url('/fullscreen/status/change') }}',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    console.log("Anti Cheating Steps Recorded Successfully")
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>

    {{-- code for question answer submit --}}
    <script>
        var questionDivLength = $('.questionDiv').length;

        var editor = '';
        var textareas = document.querySelectorAll(".code_answer");
        for (var i = 0; i < textareas.length; i++) {
            editor = CodeMirror.fromTextArea(textareas[i], {
                mode: "javascript",
                theme: "material",
                lineNumbers: false,
                autoCloseTags: true,
                autoCloseBrackets: true
            });
            editor.setSize("100%", "350");
            editor.on('keyup', function(cMirror) {
                $("#code_answer_" + start).text(cMirror.getValue());
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function noSkip() {
            $("#nextBtn_" + start).show();
            $("#skipQuestion_" + start).removeClass("d-block");
            $("#skipQuestion_" + start).hide();
        }

        function yesSkip(){

            clearInterval(intervalId);
            clearInterval(timeOfLastQuestion);

            $("#skipQuestion_"+start).removeClass("d-block");
            $("#skipQuestion_"+start).hide();
            $(".loading").show();
            stopUploadAudioByChunk();
            stopRecording();
        }

        function submitQuestionAnswer() {

            // $('#questionForm_'+start+' input').attr('readonly', 'readonly');
            $("#nextBtn_"+start).hide();
            var questionType = $("#question_type_"+start).val();
            var skipQuestion = "<b id='skipQuestion_"+start+"' class='pt-3 d-block'>Are You Sure you want to skip ? <a href='javascript:void(0)' class='btn btn-sm btn-success' id='noSkip' onclick='noSkip()'>No</a> <a href='javascript:void(0)' class='btn btn-sm btn-danger' id='yesSkip' onclick='yesSkip()'>Yes</a></b>";

            if(questionType == 1 || questionType == 3){ // mcq question type
                var mcqNullAnswerCheck = $('#questionForm_'+start).find('input[name="answer[]"]:checked').val()
                if(typeof mcqNullAnswerCheck === 'undefined' || mcqNullAnswerCheck == ''){
                    $("#nextBtn_"+start).after(skipQuestion);
                }
                else{
                    clearInterval(intervalId);
                    clearInterval(timeOfLastQuestion);
                    $(".loading").show();
                    stopUploadAudioByChunk();
                    stopRecording();
                }
            }

            if (questionType == 2 || questionType == 4) {
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var openEndedNullAnswerCheck = $("#open_ended_answer_"+start).val();
                if(typeof openEndedNullAnswerCheck === 'undefined' || openEndedNullAnswerCheck == ''){
                    $("#nextBtn_"+start).after(skipQuestion);
                }
                else{
                    clearInterval(intervalId);
                    clearInterval(timeOfLastQuestion);
                    $(".loading").show();
                    stopUploadAudioByChunk();
                    stopRecording();
                }
            }

            if(questionType == 5){
                var codeNullAnswerCheck = $("#code_answer_"+start).val();
                if(typeof codeNullAnswerCheck === 'undefined' || codeNullAnswerCheck == ''){
                    $("#nextBtn_"+start).after(skipQuestion);
                }
                else{
                    clearInterval(intervalId);
                    clearInterval(timeOfLastQuestion);
                    $(".loading").show();
                    stopUploadAudioByChunk();
                    stopRecording();
                }
            }

        }

        function submitQuestionAnswerFinal() {

            clearInterval(intervalId);
            clearInterval(timeOfLastQuestion);

            Webcam.snap(function(data_uri) {
                $("#image-tag-" + start).val(data_uri);
            });

            //For getting the ckeditor value start
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            var formData = new FormData(document.getElementById("questionForm_" + start));

            $.ajax({
                type: 'POST',
                url: '{{ url('/test/answer/submit') }}/' + start,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {

                    $("#questionsOfTest_" + start).css('display', 'none');
                    var next = Number(start) + 1;
                    $("#questionsOfTest_" + next).css('display', 'block');
                    window.scrollTo(0, 0);

                    var questionNumbering = $("#question_numbering_" + next).html();
                    $("#question_numbering_on_top").html(questionNumbering);

                    var questionMarks = $("#question_marks_" + next).html();
                    $("#test_marks").html(questionMarks);

                    if ($("#question_type_" + start).val() == 2 || $("#question_type_" + start).val() == 4) {
                        var textarea = document.getElementById('open_ended_answer_' + next);
                        CKEDITOR.replace(textarea, {
                            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                            filebrowserUploadMethod: 'form'
                        });
                    }

                    var candidate_slug_for_next_test = $('#questionForm_' + start).find(
                        'input[name="candidate_slug"]').val();
                    var assesment_slug_for_next_test = $('#questionForm_' + start).find(
                        'input[name="assesment_slug"]').val();
                    var test_running_now = $('#questionForm_' + start).find('input[name="test_running_now"]')
                        .val();

                    start++;

                    $(".loading").hide();

                    if (start > questionDivLength) {
                        var host = window.location.host;
                        location.href = "http://127.0.0.1:8000/next/test/" + assesment_slug_for_next_test +
                            "/" + candidate_slug_for_next_test + "/" + test_running_now;
                    } else {
                        if (microphonePermission == true) {
                            //start recording audio for the next test...
                            startRecording();
                            startAudioChunkUploadInterval();
                        }
                        uploadUsedTimeOfLastQuestion();
                        timeManagement();
                        Webcam.attach('#my_camera_' + start);
                        $("#my_camera_" + start).css({
                            "display": "none"
                        });
                    }

                }
            });
        }
    </script>

    <script type="text/javascript">
        CKEDITOR.replace('open_ended_answer', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>

    <script>
        $(document).ready(function() {
            window.history.pushState(null, "", window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, "", window.location.href);
            };

            // take body to change the content
            const body = document.getElementsByTagName('body');
            // stop keyboard shortcuts
            window.addEventListener("keydown", (event) => {
                if (event.ctrlKey && (event.key === "S" || event.key === "s")) {
                    event.preventDefault();
                }
                if (event.ctrlKey && (event.key === "C")) {
                    event.preventDefault();
                }
                if (event.ctrlKey && (event.key === "E" || event.key === "e")) {
                    event.preventDefault();
                }
                if (event.ctrlKey && (event.key === "I" || event.key === "i")) {
                    event.preventDefault();
                }
                if (event.ctrlKey && (event.key === "K" || event.key === "k")) {
                    event.preventDefault();
                }
                if (event.ctrlKey && (event.key === "U" || event.key === "u")) {
                    event.preventDefault();
                }
                if (event.key === "F12") {
                    event.preventDefault();
                }
            });
            // stop right click
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });

        });
    </script>

    <script src="{{ url('frontend_assets') }}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
@endsection
