@extends('backend.master')

@section("content")
<!-- Test Bank start -->
<section>
    <div class="test">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="test_heading text-center">
                        <h1>Add Question to your Test</h1>
                    </div>
                </div>
                <div class="col-lg-12 pt-5 pb-5">
                    <form action="{{url("create/test/second")}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="questions_of_test" style="border: 2px solid #376678; min-height: 100px; padding: 20px 30px; border-radius: 4px;color: #376678; font-family: 'Roboto', sans-serif; font-weight: 600">

                        </div>

                        <input type="text" id="addUnderBatch" style="min-width: 170px; margin-top: 10px; padding: 3px 10px" placeholder="Write Batch Number"> <a href="javascript:void(0)" onclick="addByBatch()" style="color:white; border-radius: 3px; display:inline-block; margin-top: 10px; padding: 4px 10px; background:#376678">Add By Batch Number</a>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12 text-center pt-4">
                                    <style>
                                        button{
                                            border: none;
                                            background: #376678;
                                            color: white;
                                            padding: 10px 25px;
                                            cursor: pointer;
                                            border-radius: 5px;
                                            font-weight: 600
                                        }
                                        a.beforeSubmit{
                                            display: inline-block;
                                            background: #376678;
                                            color: white;
                                            padding: 10px 25px;
                                            cursor: pointer;
                                            border-radius: 5px;
                                            font-weight: 600
                                        }
                                    </style>
                                    <a class="beforeSubmit" href="javascript:void(0)" onclick="submitCheck()"> Finish Test Creatrion  <i class="fas fa-arrow-right"></i></a>
                                    <button id="submit_btn" type="submit" style="display: none"> Finish Test Creation  <i class="fas fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="test_content">
                <div class="test_bank_input">
                    <div class="row">
                        <div class="col-lg-6 m-auto">
                            <i class="fas fa-search"></i>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search for Question Here">
                        </div>
                    </div>
                </div>
                <div class="row wow fadeInUp" data-wow-duration="1.2s" id="question_coloumn">
                    @foreach ($questions as $question)
                    <div class="col-lg-4 text-center" id="question_<?php echo $question->slug ?>">
                        <div class="card" style="height: 200px">
                            <div class="card-header text-left">
                                <h3>
                                    @if($question->question_type == 1)
                                    <i class="fas fa-check"></i> MCQ
                                    @elseif($question->question_type == 2)
                                    <i class="far fa-edit"></i> Open Ended
                                    @elseif($question->question_type == 3)
                                    <i class="fas fa-check"></i> MCQ +
                                    <i class="far fa-file-alt"></i> File
                                    @else
                                    <i class="far fa-edit"></i> Open Ended +
                                    <i class="far fa-file-alt"></i> File
                                    @endif
                                <h3>
                            </div>
                            <div class="card-body text-left">
                                <h3>
                                    <input type="hidden" id="question_title_{{$question->slug}}" value="{{$question->question}}">
                                    <input type="hidden" class="question_batch_{{$question->batch}}" value="{{$question->question}}">
                                    @php
                                    if(strlen($question->question) > 65){
                                        echo substr($question->question,0,64)."...";
                                    }
                                    else{
                                        echo $question->question;
                                    }
                                    @endphp
                                    <br>
                                    @if($question->batch != null)
                                    ({{$question->batch}})
                                    @endif
                                </h3>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$question->slug}}" data-original-title="Preview" class="preview previewQuestion"><i class="far fa-eye"></i> Preview</a>
                                        <a href="javascript:void(0)" id="{{$question->slug}}"  onclick="addQuestionToTheTest(this.id)"><i class="fas fa-plus-circle"></i> Add to Test</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Test Bank end-->


<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading" style="color: #376678"></h5>
            </div>
            <div class="modal-body">
                <p>
                    <b style="color: #376678; font-family: 'Roboto', sans-serif;">Question :</b>
                    <span id="modal_question" style="font-family: 'Roboto', sans-serif;"></span>
                </p>
                <br>
                <p id="modal_mcq_section" style="display: none">
                    <b style="color: #376678; font-family: 'Roboto', sans-serif;">MCQ :</b><br>
                    <span id="modal_mcq" style="font-family: 'Roboto', sans-serif;"></span>
                </p>
                <p id="modal_answer_section" style="display: none">
                    <b style="color: #376678; font-family: 'Roboto', sans-serif;">Possible Answer :</b><br>
                    <style>
                        #modal_answer ol{
                            list-style: square;
                            padding-left: 16px;
                        }
                    </style>
                    <span id="modal_answer" style="font-family: 'Roboto', sans-serif;"></span>
                </p>
                <br>
                <p id="modal_file_section" style="display: none">
                    <b style="color: #376678; font-family: 'Roboto', sans-serif;">Question File :</b><br>
                    <a id="model_file" style="font-family: 'Roboto', sans-serif;" href="">Download Link</a>
                </p>
            </div>
        </div>
    </div>
</div>


@endsection

@section("footer_js")
<script type="text/javascript">

    function submitCheck(){
        var slNumber = $('#questions_of_test div').length;
        if(slNumber <= 0){
            alert("Please Add at least One Question");
            return false
        }else{
            document.getElementById('submit_btn').click()
        }
    }

    function addByBatch(){
        $("#questions_of_test").html('');
        var batch = $("#addUnderBatch").val();
        $(".question_batch_"+batch).each(function(index, value){
            var slug = $(this).prev('input').attr("id");
            var myarr = slug.split("_");
            var myvalue = myarr[2];
            var title = $(this).prev('input').val();
            var serial = Number($('#questions_of_test p').length)+1;
            var str = "<div id='question_no_"+serial+"'><p>Question : "+title+"<input type='hidden' class='questions' value='"+myvalue+"' name='question[]'> <a href='javascript:void(0)' onclick='deleteQuestionFromTest("+serial+")' class='text-danger'><i class='fas fa-times'></i></a></p></div>"
            $("#questions_of_test").append(str);
        });
    }

    function addQuestionToTheTest(value){
        var duplicate = 0;
        $( "input.questions" ).each(function( index, element ) {
            if ($(this).val() == value) {
                alert("Already Added");
                duplicate++;
                return false;
            }
        });

        if(duplicate == 0){
            var title = $("#question_title_"+value).val();
            var serial = Number($('#questions_of_test p').length)+1;
            var str = "<div id='question_no_"+serial+"'><p>Question : "+title+"<input type='hidden' class='questions' value='"+value+"' name='question[]'> <a href='javascript:void(0)' onclick='deleteQuestionFromTest("+serial+")' class='text-danger'><i class='fas fa-times'></i></a></p></div>"
            $("#questions_of_test").append(str);
        }
    }

    function deleteQuestionFromTest(value){
        $("#question_no_"+value).remove();
    }

    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.previewQuestion', function () {
            var slug = $(this).data('id');
            $.get("{{ url('get/data/of/question') }}" +'/' + slug, function (data) {
                $('#modal_mcq_section').css("display","none")
                $('#modal_answer_section').css("display","none")
                $('#modal_file_section').css("display","none")
                $('#modelHeading').html("<b>Preview Question</b>");
                $('#ajaxModel').modal('show');
                $('#modal_question').html(data.data.question);
                if(data.data.question_type == 1 || data.data.question_type == 3){
                    $('#modal_mcq_section').css("display","block");
                    $('#modal_mcq').html(data.str);
                }
                if(data.data.question_type == 2 || data.data.question_type == 4){
                    $('#modal_answer_section').css("display","block");
                    $('#modal_answer').html(data.data.answer);
                }
                if(data.data.question_type == 3 || data.data.question_type == 4){
                    if(data.data.question_file != null){
                        $('#modal_file_section').css("display","block");
                        var base_url = window.location.origin;
                        var url = base_url+"/"+data.data.question_file;
                        $("a#model_file").attr("href", url);
                        $("a#model_file").attr("download", url);
                    }
                }
            })
        });

        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('/search/question/for/add/to/test')}}',
                data:{'search':$value},
                success:function(data){
                    $('#question_coloumn').html(data);
                }
            });
        })

    });
</script>
@endsection
