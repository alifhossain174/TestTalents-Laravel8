@extends('backend.master')

@section("header_css")
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
    <link rel="stylesheet" href="{{url('codeMirror')}}/css/codemirror.css">
    <link rel="stylesheet" href="{{url('codeMirror')}}/css/themes/material.css">
    <link href="{{url('select2Autocomplete')}}/select2.min.css" rel="stylesheet" />

    <style>
        span#addQPassage{
            font-size: 12px;
            background: #1D4354;
            color: white;
            padding: 2px 8px;
            border-radius: 3px;
            cursor: pointer;
            box-shadow: 5px 5px 5px rgb(162, 162, 162);
            display: inline-block;
            margin-bottom: 5px;
            transition: all .2s linear;
        }
        span#addQPassage:hover{
            box-shadow: none;
        }

        label{
            font-weight: 600;
            font-size: 16px;
        }
        span.select2-container{
            width: 100% !important;
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

    <form action="{{url('create/new/question')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- backend navigation start-->
        <section>
            <div class="backend_navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="navigation_title">
                                <h3>Add New Question</h3>
                                <b>This Question will be used to create Test</b>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="navigation_item pt-2">
                                <ul>
                                    <li class="active">
                                        <button type="submit" style="cursor: pointer"><i class="far fa-calendar-check"></i> Submit Question</button>
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
                                <div class="row">
                                    <div class="col-lg-5 border-right">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Question Type</label>
                                                    <select name="question_type" id="question_type_select" class="form-control" onchange="showHideInputs(this.value)" required>
                                                        <option value="">Select One</option>
                                                        <option value="1">Multiple Choice (One or Multiple Correct Answers)</option>
                                                        <option value="2">Essay (Open Text Answer)</option>
                                                        <option value="3">Image/PDF/Video/Audio (One or Multiple Correct Answers)</option>
                                                        <option value="4">Image/PDF/Video/Audio (Open Text Answer)</option>
                                                        <option value="5">Code (Programming Questions)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" id="questionPassage" style="display: none;">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Question Passage</label>
                                                    <textarea name="passage" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <span id="addQPassage" onclick="showHideQuestionPassage()">Add Passage</span>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="d-block mt-2">Write the Question Here</label>
                                                    <textarea name="question" placeholder="Write the Question Here" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" id="question_file" style="display: none">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Upload File</label>
                                                    <input type="file" id="question_file_input" name="question_file" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <img id="blah2" alt="" class="img-fluid mt-1">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Marks</label>
                                                    <input type="number" step=".01" name="marks" placeholder="eg. 10" class="form-control" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Time (In Minutes)</label>
                                                    <input type="number" step=".01" name="time" placeholder="eg. 15" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Question Batch No</label>
                                                    <input name="batch" placeholder="Question Batch" value="<?php echo time();?>" class="form-control" required>
                                                    <span style="font-size: 12px;color:gray;">Every question will have its own unique bacth number to identify it. Use Same Batch No. To create group of Question for Test</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">

                                        <div class="form-group" id="answer_textfield" style="display: none;">
                                            <label># Write the possible Answer here :</label>
                                            <textarea class="form-control" name="editor1"></textarea>
                                        </div>

                                        <div class="form-group" id="answer_mcq" style="display: none;">
                                            <label class="mb-3"># Write the MCQ options and select the write Answer : <a style="display: inline-block; background:lightgreen; padding: 1px 5px; border-radius: 4px; cursor:pointer; box-shadow: 5px 5px 15px rgb(182, 182, 182)" onclick="addExtraOption()">Click to add extra option</a></label>
                                            <div class="row" id="add_new_option">
                                                <div id="remove_1" class="col-lg-1 text-right pr-0 pt-2 mb-1">
                                                    <input class="" name='answer[]' type="radio" value="1">
                                                </div>
                                                <div id="remove_1" class="col-lg-10 mb-1">
                                                    <input type="text" name="mcq[]" class="form-control">
                                                </div>
                                                <div id="remove_1" class="col-lg-1 text-left pl-0">
                                                    <a class="d-block pt-1 text-danger" style="cursor:pointer" onclick="removeOption(1)"><i class="fas fa-times"></i></a>
                                                </div>

                                                <div id="remove_2" class="col-lg-1 text-right pr-0 pt-2 mb-1">
                                                    <input class="" name='answer[]' type="radio" value="2">
                                                </div>
                                                <div id="remove_2" class="col-lg-10 mb-1">
                                                    <input type="text" name="mcq[]" class="form-control">
                                                </div>
                                                <div id="remove_2" class="col-lg-1 text-left pl-0">
                                                    <a class="d-block pt-1 text-danger" style="cursor:pointer" onclick="removeOption(2)"><i class="fas fa-times"></i></a>
                                                </div>

                                                <div id="remove_3" class="col-lg-1 text-right pr-0 pt-2 mb-1">
                                                    <input class="" name='answer[]' type="radio" value="3">
                                                </div>
                                                <div id="remove_3" class="col-lg-10 mb-1">
                                                    <input type="text" name="mcq[]" class="form-control">
                                                </div>
                                                <div id="remove_3" class="col-lg-1 text-left pl-0">
                                                    <a class="d-block pt-1 text-danger" style="cursor:pointer" onclick="removeOption(3)"><i class="fas fa-times"></i></a>
                                                </div>

                                                <div id="remove_4" class="col-lg-1 text-right pr-0 pt-2 mb-1">
                                                    <input class="" name='answer[]' type="radio" value="4">
                                                </div>
                                                <div id="remove_4" class="col-lg-10 mb-1">
                                                    <input type="text" name="mcq[]" class="form-control">
                                                </div>
                                                <div id="remove_4" class="col-lg-1 text-left pl-0">
                                                    <a class="d-block pt-1 text-danger" style="cursor:pointer" onclick="removeOption(4)"><i class="fas fa-times"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" id="coding_textfield" style="display: none;">

                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <label># Select Programming Language (Required) :</label>
                                                    <select name="programming_language" id="programming_language" class="form-control select2">

                                                    </select>
                                                </div>
                                            </div>

                                            <label># Write the possible code here (Optional) :</label>
                                            <textarea id="codeEditor" name="codeEditor"></textarea>
                                            <a class="btn btn-sm btn-success rounded mt-1 mb-2 text-white" id="execute"><img src="{{url('images')}}/loader3.gif" style="height: 17px;width:17px;margin-right:5px;display:none" class="loading"><b>Execute</b></a>
                                            <label class="d-block">See the Results Here :</label>
                                            <div id="result" style="width: 100%; min-height: 100px; background:rgb(213, 213, 213); border-radius: 5px; padding: 5px 10px">

                                            </div>
                                            <script>
                                                var editor = CodeMirror.fromTextArea(document.getElementById('codeEditor'), {
                                                    mode: "javascript",
                                                    theme: "material",
                                                    // lineNumbers: true,
                                                    autoCloseTags: true,
                                                    autoCloseBrackets: true
                                                });
                                                editor.setSize("100%", "400");
                                            </script>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- question content end-->

    </form>
@endsection


@section('footer_js')
    <script src="{{url('select2Autocomplete')}}/select2.min.js"></script>
    <script type="text/javascript">

        $('#programming_language').select2({
            placeholder: 'Search for Programming Language',
            ajax: {
                url: '{{ url('/autocompleteSearchProgrammingLanguage') }}',
                dataType: 'json',
                delay: 0,
                processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.code
                        }
                    })
                };
                },
                cache: true
            }
        });
    </script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#execute').click(function (e) {

            e.preventDefault();
            $(".loading").css('display','inline-block')
            $("#result").html("");
            var data = editor.getValue();
            var pl_code = $('#programming_language').val();

            if($('#programming_language').val() == null){
                toastr.error("Please Select Programming Language");
                $(".loading").css('display','none');
                return false;
            }
            if(data == ''){
                toastr.error("Please Write Some Code");
                $(".loading").css('display','none');
                return false;
            }

            $.ajax({
                data: {data:data, pl_code:pl_code},
                url: "{{ url('/compile/code') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $("#result").html(data.output.replace("jdoodle", "index"));
                    $(".loading").css('display','none')
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>

    <script type="text/javascript">
        CKEDITOR.replace('editor1', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

    <script type="text/javascript">
        CKEDITOR.replace('passage', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('question', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

    <script>
        function showHideInputs(value){

            $('#blah2').attr('src', ''); // remove the preview image

            if(value == 3 || value == 4){
                $("#question_file").css("display", "block");
                $('#question_file_input').val('');
                if(value == 4){
                    $("#answer_textfield").css("display","block")
                    $("#answer_mcq").css("display","none")
                    $("#coding_textfield").css("display","none");
                }
                else{
                    $("#answer_textfield").css("display","none")
                    $("#answer_mcq").css("display","block")
                    $("#coding_textfield").css("display","none");
                }
            }
            else{
                $("#question_file").css("display", "none");
                $('#question_file_input').val('');
                if(value == 2){
                    $("#answer_textfield").css("display","block")
                    $("#answer_mcq").css("display","none")
                    $("#coding_textfield").css("display","none");
                }
                else if(value == 1){
                    $("#answer_textfield").css("display","none")
                    $("#coding_textfield").css("display","none");
                    $("#answer_mcq").css("display","block")
                }
                else{
                    $("#answer_textfield").css("display","none")
                    $("#answer_mcq").css("display","none")
                    $("#coding_textfield").css("display","block")
                }
            }

            if(!value){
                $("#question_file").css("display", "none");
                $("#answer_textfield").css("display","none");
                $("#answer_mcq").css("display","none");
                $("#coding_textfield").css("display","none");
            }
        }

        window.onload = function() {
            document.getElementById('question_type_select').value = '';
        }

        var id_to_remove_div = 5;

        function addExtraOption(){
            var count_options = $("#add_new_option").find('div').length;
            var radio_button_val = (Number(count_options)/3)+Number(1);

            var extraOption = "<div id='remove_"+id_to_remove_div+"' class='col-lg-1 text-right pr-0 pt-2 mb-1'>"+"<input class='' type='radio' name='answer[]' value='"+radio_button_val+"'>"+"</div>"+"<div id='remove_"+id_to_remove_div+"' class='col-lg-10 mb-1'>"+"<input type='text' class='form-control' name='mcq[]'>"+"</div><div id='remove_"+id_to_remove_div+"' class='col-lg-1 text-left pl-0'>"+"<a class='d-block pt-1 text-danger' style='cursor:pointer' onclick='removeOption("+id_to_remove_div+")'><i class='fas fa-times'></i></a></div>";

            if(count_options <= 27){
                $("#add_new_option").append(extraOption);
                id_to_remove_div++;
            }
            else{
                toastr.error("Sorry !! You Cannot Add More Options")
            }

        }

        function removeOption(value){
            var count_options = $("#add_new_option").find('div').length;
            if(count_options <= 6){
                toastr.error("At least Two Option will remain")
            }
            else{
                var contentToRemove = document.querySelectorAll("#remove_"+value);
                $(contentToRemove).remove();
            }
        }

        function showHideQuestionPassage(){
            if($("#addQPassage").text() == "Add Passage"){
                $("#questionPassage").css("display","block");
                $("#addQPassage").text("Hide Passage");
            }
            else{
                $("#questionPassage").css("display","none");
                CKEDITOR.instances['passage'].setData('');
                $("#addQPassage").text("Add Passage");
            }
        }

    </script>

    <script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

@endsection
