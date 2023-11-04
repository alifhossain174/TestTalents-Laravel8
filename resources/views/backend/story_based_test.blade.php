@extends('backend.master')

@section("header_css")
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
    <link rel="stylesheet" href="{{url('codeMirror')}}/css/codemirror.css">
    <link rel="stylesheet" href="{{url('codeMirror')}}/css/themes/material.css">
    <link href="{{url('select2Autocomplete')}}/select2.min.css" rel="stylesheet" />
    <style>
        span.select2-container{
            width: 100% !important;
        }

        label b{
            font-weight: 600;
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
    <section>
        <div class="backend_navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="navigation_title">
                            <h3>Add Questions based on Story</h3>
                            <b>All the Questions will be under this Test</b>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="navigation_item pt-2">
                            <ul>
                                <li class="active">
                                    <button style="cursor: pointer" onclick="saveQuestionsOfTest()"><i class="far fa-calendar-check"></i> Submit Question <img src="{{url('images')}}/loader3.gif" style="height:25;width:25px;margin-right:5px; display:none" id="loading"></button>
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

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label><b>Write the story here :</b></label>
                                        <textarea name="story" class="form-control story" onkeyup="copyTheText()" required></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 pt-3 questionFormSection" id="questionFormSection_1">
                                    <form id="questionForm_1" name="questionForm_1" class="form-horizontal">
                                    <b class="alert alert-info d-block w-100">
                                        <div class="row">
                                            <div class="col-lg-12"># Question 1</div>
                                        </div>
                                    </b>
                                    <hr style="margin-top: 10px !important; margin-bottom: 15px !important;">
                                    <div class="row">
                                        <div class="col-lg-5 border-right">

                                            <textarea name="passage" class="form-control d-none passage"></textarea>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label><b>Question Type :</b></label>
                                                        <select name="question_type" id="question_type_select" class="form-control" onchange="showHideInputs(this.value,1)" required>
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

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label><b>Question :</b></label>
                                                        <textarea name="question" id="question_1" placeholder="Write the Question Here" class="form-control" required></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="question_file_1" style="display: none">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label><b>Upload File :</b></label>
                                                        <input type="file" id="question_file_input_1" name="question_file" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])" class="form-control">
                                                    </div>
                                                </div>
                                                <img id="blah1" alt="" class="img-fluid mt-1">
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label><b>Question Time (In Minute like 10) :</b></label>
                                                        <input name="time" placeholder="ex. 10" onkeypress="return onlyNumberKey(event)" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label><b>Question Marks :</b></label>
                                                        <input name="marks" placeholder="Question Marks" onkeypress="return onlyNumberKey(event)" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-7">
                                            <div class="form-group" id="answer_textfield_1" style="display: none;">
                                                <label><b># Write the possible Answer here :</b></label>
                                                <textarea class="form-control" id="editor1" name="editor"></textarea>
                                            </div>

                                            <div class="form-group" id="answer_mcq_1" style="display: none;">
                                                <label class="mb-3"><b># Write the MCQ options and select the write Answer : </b><a style="display: inline-block; background:lightgreen; padding: 1px 5px; border-radius: 4px; cursor:pointer; box-shadow: 5px 5px 15px rgb(182, 182, 182)" onclick="addExtraOption(1)">Click to add extra option</a></label>
                                                <div class="row" id="add_new_option_1">
                                                    <div id="remove_11" class="col-lg-1 text-right pr-0 pt-2 mb-1">
                                                        <input class="" name='answer[]' type="radio" value="1">
                                                    </div>
                                                    <div id="remove_11" class="col-lg-10 mb-1">
                                                        <input type="text" name="mcq[]" class="form-control">
                                                    </div>
                                                    <div id="remove_11" class="col-lg-1 text-left pl-0">
                                                        <a class="d-block pt-1 text-danger" style="cursor:pointer" onclick="removeOption(1,1)"><i class="fas fa-times"></i></a>
                                                    </div>

                                                    <div id="remove_12" class="col-lg-1 text-right pr-0 pt-2 mb-1">
                                                        <input class="" name='answer[]' type="radio" value="2">
                                                    </div>
                                                    <div id="remove_12" class="col-lg-10 mb-1">
                                                        <input type="text" name="mcq[]" class="form-control">
                                                    </div>
                                                    <div id="remove_12" class="col-lg-1 text-left pl-0">
                                                        <a class="d-block pt-1 text-danger" style="cursor:pointer" onclick="removeOption(1,2)"><i class="fas fa-times"></i></a>
                                                    </div>

                                                    <div id="remove_13" class="col-lg-1 text-right pr-0 pt-2 mb-1">
                                                        <input class="" name='answer[]' type="radio" value="3">
                                                    </div>
                                                    <div id="remove_13" class="col-lg-10 mb-1">
                                                        <input type="text" name="mcq[]" class="form-control">
                                                    </div>
                                                    <div id="remove_13" class="col-lg-1 text-left pl-0">
                                                        <a class="d-block pt-1 text-danger" style="cursor:pointer" onclick="removeOption(1,3)"><i class="fas fa-times"></i></a>
                                                    </div>

                                                    <div id="remove_14" class="col-lg-1 text-right pr-0 pt-2 mb-1">
                                                        <input class="" name='answer[]' type="radio" value="4">
                                                    </div>
                                                    <div id="remove_14" class="col-lg-10 mb-1">
                                                        <input type="text" name="mcq[]" class="form-control">
                                                    </div>
                                                    <div id="remove_14" class="col-lg-1 text-left pl-0">
                                                        <a class="d-block pt-1 text-danger" style="cursor:pointer" onclick="removeOption(1,4)"><i class="fas fa-times"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="coding_textfield_1" style="display: none;">

                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <label><b># Select Programming Language (Required) :</b></label>
                                                        <select name="programming_language" id="programming_language_1" class="form-control select2">

                                                        </select>
                                                    </div>
                                                </div>

                                                <label><b># Write the possible code here (Optional) :</b></label>
                                                <textarea id="codeEditor1" name="codeEditor"></textarea>
                                                <a class="btn btn-sm btn-success rounded mt-1 mb-2 text-white" id="execute_1" onclick="runMyCode(1)"><img src="{{url('images')}}/loader3.gif" style="height:17px;width:17px;margin-right:5px;display:none" id="loading1"><b>Execute</b></a>
                                                <label class="d-block">See the Results Here :</label>
                                                <div id="result1" style="width: 100%; min-height: 100px; background:rgb(213, 213, 213); border-radius: 5px; padding: 5px 10px">

                                                </div>

                                                <script>
                                                     editor1 = CodeMirror.fromTextArea(document.getElementById('codeEditor1'), {
                                                        mode: "javascript",
                                                        theme: "material",
                                                        // lineNumbers: true,
                                                        autoCloseTags: true,
                                                        autoCloseBrackets: true
                                                    });
                                                    editor1.on('keyup', function (event) {
                                                        var value = editor1.getValue();
                                                        $('#codeEditor1').text(value);
                                                    });
                                                    editor1.setSize("100%", "300");
                                                </script>
                                            </div>

                                        </div>
                                    </div>
                                    </form>
                                </div>

                                <div class="col-lg-12">
                                    <button class="btn rounded text-white mt-3" onclick="createAnotherQuestion()" style="background: #1D4354; border-color: #1D4354">Add Another Question</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- question content end-->

@endsection


@section('footer_js')

    <script src="{{url('select2Autocomplete')}}/select2.min.js"></script>
    <script type="text/javascript">
        $('#programming_language_1').select2({
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

        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)){
                toastr.error("Time & Marks Field Only accept Numbers");
                return false;
            }
            return true;
        }
    </script>

    <script type="text/javascript">
        CKEDITOR.replace('story', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        }).on('change', function (event) {
            var value = CKEDITOR.instances['story'].getData();//Value of Editor
            // CKEDITOR.instances['story_1'].setData(value)
            // $("passage").val(value)
            $('.passage').val(value);
        });

        var textareaQuestion = document.getElementById('question_1');
        CKEDITOR.replace(textareaQuestion, {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

    <script>

        var questionSerial = 2;

        function createAnotherQuestion(){

            var story = $('.passage').val();

            var anotherQuestionSection = "<div class='col-lg-12 pt-3 questionFormSection' id='questionFormSection_"+questionSerial+"'>"+
            "<form id='questionForm_"+questionSerial+"' name='questionForm_"+questionSerial+"' class='form-horizontal'>"+
            "<b class='alert alert-info d-block w-100'>"+
                "<div class='row'>"+
                    "<div class='col-lg-8'># Question "+questionSerial+"</div>"+
                    "<div class='col-lg-4 text-right'>"+
                        "<a href='javascript:void(0)' onclick='removeQuestionSection("+questionSerial+")' class='text-danger font-weight-bolder'><i class='far fa-trash-alt'></i></a>"+
                    "</div>"+
                "</div>"+
            "</b>"+
            "<hr style='margin-top: 10px !important; margin-bottom: 15px !important;'>"+
            "<div class='row'>"+
                "<div class='col-lg-5 border-right'>"+
                    "<div class='form-group'>"+
                        "<div class='row'>"+
                            "<div class='col-lg-12'>"+
                                "<label><b>Question Type :</b></label>"+
                                "<select name='question_type' id='question_type_select' class='form-control' onchange='showHideInputs(this.value,"+questionSerial+")' required>"+
                                    "<option value=''>Select One</option>"+
                                    "<option value='1'>Multiple Choice (One or Multiple Correct Answers)</option>"+
                                    "<option value='2'>Essay (Open Text Answer)</option>"+
                                    "<option value='3'>Image/PDF/Video/Audio (One or Multiple Correct Answers)</option>"+
                                    "<option value='4'>Image/PDF/Video/Audio (Open Text Answer)</option>"+
                                    "<option value='5'>Code (Programming Questions)</option>"+
                                "</select>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                    "<div class='form-group'>"+
                        "<div class='row'>"+
                            "<div class='col-lg-12'>"+
                                "<textarea name='passage' class='form-control d-none passage'>"+story+"</textarea>"+
                                "<label><b>Question :</b></label>"+
                                "<textarea name='question' id='question_"+questionSerial+"' placeholder='Write the Question Here' class='form-control' required></textarea>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                    "<div class='form-group' id='question_file_"+questionSerial+"' style='display: none'>"+
                        "<div class='row'>"+
                            "<div class='col-lg-12'>"+
                                "<label><b>Upload File :</b></label>"+
                                "<input type='file' id='question_file_input_"+questionSerial+"' name='question_file' onchange='document.getElementById('blah"+questionSerial+"').src='window.URL.createObjectURL(this.files[0])' class='form-control'>"+
                            "</div>"+
                        "</div>"+
                        "<img id='blah"+questionSerial+"' alt='' class='img-fluid mt-1'>"+
                    "</div>"+
                    "<div class='form-group'>"+
                        "<div class='row'>"+
                            "<div class='col-lg-12'>"+
                                "<label><b>Question Time (In Minute like 10) :</b></label>"+
                                "<input name='time' placeholder='ex. 10' onkeypress='return onlyNumberKey(event)' class='form-control' required>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                    "<div class='form-group'>"+
                        "<div class='row'>"+
                            "<div class='col-lg-12'>"+
                                "<label><b>Question Marks :</b></label>"+
                                "<input name='marks' placeholder='Question Marks' onkeypress='return onlyNumberKey(event)' class='form-control' required>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-lg-7'>"+
                    "<div class='form-group' id='answer_textfield_"+questionSerial+"' style='display: none;'>"+
                        "<label><b># Write the possible Answer here :</b></label>"+
                        "<textarea class='form-control' id='editor"+questionSerial+"' name='editor'></textarea>"+
                    "</div>"+
                    "<div class='form-group' id='answer_mcq_"+questionSerial+"' style='display: none;'>"+
                        "<label class='mb-3'>"+
                            "<b># Write the MCQ options and select the write Answer : </b>"+
                            "<a style='display: inline-block; background:lightgreen; padding: 1px 5px; border-radius: 4px; cursor:pointer; box-shadow: 5px 5px 15px rgb(182, 182, 182)' onclick='addExtraOption("+questionSerial+")'>Click to add extra option</a>"+
                        "</label>"+
                        "<div class='row' id='add_new_option_"+questionSerial+"'>"+
                            "<div id='remove_"+questionSerial+"1' class='col-lg-1 text-right pr-0 pt-2 mb-1'>"+
                                "<input name='answer[]' type='radio' value='1'>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"1' class='col-lg-10 mb-1'>"+
                                "<input type='text' name='mcq[]' class='form-control'>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"1' class='col-lg-1 text-left pl-0'>"+
                                "<a class='d-block pt-1 text-danger' style='cursor:pointer' onclick='removeOption("+questionSerial+",1)'>"+
                                    "<i class='fas fa-times'></i>"+
                                "</a>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"2' class='col-lg-1 text-right pr-0 pt-2 mb-1'>"+
                                "<input name='answer[]' type='radio' value='2'>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"2' class='col-lg-10 mb-1'>"+
                                "<input type='text' name='mcq[]' class='form-control'>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"2' class='col-lg-1 text-left pl-0'>"+
                                "<a class='d-block pt-1 text-danger' style='cursor:pointer' onclick='removeOption("+questionSerial+",2)'>"+
                                    "<i class='fas fa-times'></i>"+
                                "</a>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"3' class='col-lg-1 text-right pr-0 pt-2 mb-1'>"+
                                "<input name='answer[]' type='radio' value='3'>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"3' class='col-lg-10 mb-1'>"+
                                "<input type='text' name='mcq[]' class='form-control'>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"3' class='col-lg-1 text-left pl-0'>"+
                                "<a class='d-block pt-1 text-danger' style='cursor:pointer' onclick='removeOption("+questionSerial+",3)'>"+
                                   "<i class='fas fa-times'></i>"+
                                "</a>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"4' class='col-lg-1 text-right pr-0 pt-2 mb-1'>"+
                                "<input name='answer[]' type='radio' value='4'>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"4' class='col-lg-10 mb-1'>"+
                                "<input type='text' name='mcq[]' class='form-control'>"+
                            "</div>"+
                            "<div id='remove_"+questionSerial+"4' class='col-lg-1 text-left pl-0'>"+
                                "<a class='d-block pt-1 text-danger' style='cursor:pointer' onclick='removeOption("+questionSerial+",4)'>"+
                                    "<i class='fas fa-times'></i>"+
                                "</a>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                    "<div class='form-group' id='coding_textfield_"+questionSerial+"' style='display: none;'>"+

                        "<div class='row mb-3'>"+
                            "<div class='col-lg-12'>"+
                                "<label><b># Select Programming Language (Required) :</b></label>"+
                                "<select name='programming_language' id='programming_language_"+questionSerial+"' class='form-control select2Tag'>"+
                                "</select>"+
                            "</div>"+
                        "</div>"+

                        "<label><b># Write the possible code here (Optional) :</b></label>"+
                        "<textarea id='codeEditor"+questionSerial+"' name='codeEditor'></textarea>"+

                        "<a class='btn btn-sm btn-success rounded mt-1 mb-2 text-white' id='execute_"+questionSerial+"' onclick='runMyCode("+questionSerial+")'>"+
                            "<img src='"+window.location.origin+"/images/loader3.gif' style='height: 17px;width:17px;margin-right:5px;display:none' id='loading"+questionSerial+"'>"+
                            "<b>Execute</b>"+
                        "</a>"+

                        "<label class='d-block'>See the Results Here :</label>"+

                        "<div id='result"+questionSerial+"' style='width: 100%; min-height: 100px; background:rgb(213, 213, 213); border-radius: 5px; padding: 5px 10px'>"+

                        "</div>"+

                        "<script>"+
                            "var editor"+questionSerial+" = CodeMirror.fromTextArea(document.getElementById('codeEditor"+questionSerial+"'), {"+
                                "mode: 'javascript',"+
                                "theme: 'material',"+
                                "autoCloseTags: true,"+
                                "autoCloseBrackets: true"+
                            "});"+

                            "editor"+questionSerial+".on('keyup', function (event) {"+
                                "var value = editor"+questionSerial+".getValue();"+
                                "$('#codeEditor"+questionSerial+"').text(value);"+
                            "});"+

                            "editor"+questionSerial+".setSize('100%', '300');"+
                        "<\/script>"+

                    "</div>"+
                "</div>"+
            "</div>"+
            "</form>"+
            "</div>";

            if(questionSerial == 2){
                $("#questionFormSection_1").after(anotherQuestionSection);

                let textareaQuestion = document.getElementById('question_'+questionSerial);
                CKEDITOR.replace(textareaQuestion, {
                    filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form'
                });
            }
            else{
                var nextNumberToBe = Number(questionSerial);
                var nextNumber = Number(nextNumberToBe)-1;
                $("#questionFormSection_"+nextNumber).after(anotherQuestionSection);

                let textareaQuestion = document.getElementById('question_'+questionSerial);
                CKEDITOR.replace(textareaQuestion, {
                    filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form'
                });
            }

            questionSerial++;
        }

        function showHideInputs(value,id){

            $('#blah'+id).attr('src', ''); // remove the preview image
            if(value == 3 || value == 4){
                $("#question_file_"+id).css("display", "block");
                $('#question_file_input_'+id).val('');
                if(value == 4){
                    $("#answer_textfield_"+id).css("display","block")

                    CKEDITOR.replace(document.getElementById('editor'+id), {
                        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                        filebrowserUploadMethod: 'form'
                    });

                    $("#answer_mcq_"+id).css("display","none")
                    $("#coding_textfield_"+id).css("display","none");
                }
                else{
                    $("#answer_textfield_"+id).css("display","none")
                    $("#answer_mcq_"+id).css("display","block")
                    $("#coding_textfield_"+id).css("display","none");
                }
            }
            else{
                $("#question_file_"+id).css("display", "none");
                $('#question_file_input_'+id).val('');
                if(value == 2){
                    $("#answer_textfield_"+id).css("display","block")

                    CKEDITOR.replace(document.getElementById('editor'+id), {
                        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                        filebrowserUploadMethod: 'form'
                    });

                    $("#answer_mcq_"+id).css("display","none")
                    $("#coding_textfield_"+id).css("display","none");
                }
                else if(value == 1){
                    $("#answer_textfield_"+id).css("display","none")
                    $("#coding_textfield_"+id).css("display","none");
                    $("#answer_mcq_"+id).css("display","block")
                }
                else{
                    $("#answer_textfield_"+id).css("display","none")
                    $("#answer_mcq_"+id).css("display","none")
                    $("#coding_textfield_"+id).css("display","block")

                    if(id != 1){
                        $.ajax({
                            url: "{{ url('/get/all/pl') }}",
                            type: "GET",
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                $('#programming_language_'+id).append('<option value="">Select Programming Language</option>');
                                $.each(data, function(key, value) {
                                    $("select[id='programming_language_"+id+"']").append('<option value="'+ value.code +'">'+ value.name +'</option>');
                                });
                                $('.select2Tag').select2();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }

                }
            }
            if(!value){
                $("#question_file_"+id).css("display", "none");
                $("#answer_textfield_"+id).css("display","none");
                $("#answer_mcq_"+id).css("display","none");
                $("#coding_textfield_"+id).css("display","none");
            }
        }

        window.onload = function() {
            document.getElementById('question_type_select').value = '';
        }

        function addExtraOption(id){
            var count_options = $("#add_new_option_"+id).find('div').length;
            var radio_button_val = (Number(count_options)/3)+Number(1);

            var extraOption = "<div id='remove_"+id+radio_button_val+"' class='col-lg-1 text-right pr-0 pt-2 mb-1'>"+
            "<input class='' type='radio' name='answer[]' value='"+radio_button_val+"'>"+
            "</div>"+"<div id='remove_"+id+radio_button_val+"' class='col-lg-10 mb-1'>"+
                "<input type='text' class='form-control' name='mcq[]'>"+
            "</div>"+
            "<div id='remove_"+id+radio_button_val+"' class='col-lg-1 text-left pl-0'>"+
                "<a class='d-block pt-1 text-danger' style='cursor:pointer' onclick='removeOption("+id+","+radio_button_val+")'><i class='fas fa-times'></i></a>"+
            "</div>";

            if(count_options <= 27){
                $("#add_new_option_"+id).append(extraOption);
            }
            else{
                toastr.error("Sorry !! You Cannot Add More Options")
            }
        }

        function removeOption(id,value){
            var count_options = $("#add_new_option_"+id).find('div').length;
            if(count_options <= 6){
                toastr.error("At least Two Option will remain")
            }
            else{
                var contentToRemove = document.querySelectorAll("#remove_"+id+value);
                $(contentToRemove).remove();
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var formSerial = 1;
        function saveQuestionsOfTest(){

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            // checking validation start
            var validation_serial = 1;
            var max_validation_serial = Number($('.questionFormSection').length);

            for(validation_serial; validation_serial <= max_validation_serial; validation_serial++){

                var time = $('#questionFormSection_'+validation_serial).find('input[name="time"]').val();
                var marks = $('#questionFormSection_'+validation_serial).find('input[name="marks"]').val();
                var question = $('#questionFormSection_'+validation_serial).find('textarea[name="question"]').val();
                var questionType = $('#questionFormSection_'+validation_serial).find('select[name="question_type"]').val();

                if(questionType == ''){
                    toastr.error("Please Select Question Type for Question No."+validation_serial);
                    return false;
                }

                var mcqValidation = 0;
                var mcqOptionNullValidation = 0;
                if(questionType == 1 || questionType == 3){
                    $('#questionFormSection_'+validation_serial).find('input[name="answer[]"]').each(function(){
                        if ($(this).prop("checked")){
                            mcqValidation = 1
                            console.log("An Answer is Selected");
                        }
                    });

                    $('#questionFormSection_'+validation_serial).find('input[name="mcq[]"]').each(function(){
                        if ($(this).val() == ''){
                            mcqOptionNullValidation = 1
                            console.log("A option is Null");
                        }
                    });
                }

                if((questionType == 1 || questionType == 3) && mcqValidation == 0){
                    toastr.error("Please Select At Least One Right Ans for Question No."+validation_serial);
                    return false;
                }

                if((questionType == 1 || questionType == 3) && mcqOptionNullValidation == 1){
                    toastr.error("Option cannot be null for Question No."+validation_serial);
                    return false;
                }

                if(question == ''){
                    toastr.error("Please Write Question No. "+validation_serial);
                    return false;
                }

                if(time == 0 || time == ''){
                    toastr.error("Please provide Time for Question No. "+validation_serial);
                    return false;
                }
                if(marks == 0 || marks == ''){
                    toastr.error("Please provide Marks for Question No. "+validation_serial);
                    return false;
                }

            }
            // checking validation end


            $("#loading").css('display','inline');

            var numItems = Number($('.questionFormSection').length);

            if(numItems != 0){

                var formData = new FormData(document.getElementById("questionForm_"+formSerial))

                $.ajax({
                    type : 'POST',
                    url : '{{ url('create/story/based/test') }}',
                    // data: $('#questionForm_'+formSerial).serialize(),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    // dataType: 'json',
                    success:function(data){
                        // console.log("Success");
                        formSerial++;
                        if(formSerial <= numItems){
                            saveQuestionsOfTest();
                        }
                        else{
                            // location.href = "http://127.0.0.1:8000/view/all/tests";
                            location.href = "https://testtalents.com/view/all/tests";
                        }
                    }
                });
            }

        }


        function runMyCode(id){
            $('#loading'+id).css('display','inline-block')
            $('#result'+id).html('');
            var data = $('#codeEditor'+id).text();
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

        function removeQuestionSection(id){
            $("#questionFormSection_"+id).remove();
            questionSerial--;
        }
    </script>

    <script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

@endsection
