@extends('backend.master')

@section("header_js")
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
@endsection

@section("content")
<!-- Test Bank start -->
<section>
    <div class="test">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="test_heading text-center">
                        <h1>Question Bank</h1>
                        <p class="mt-2">
                            <a href="{{url("/add/question/page")}}" style="color: #1D4354;"><u>Add New Question</u></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="test_content">
                <div class="test_bank_input">
                    <div class="row">
                        <div class="col-lg-6 m-auto">
                            <i class="fas fa-search"></i>
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="Search for Question Here">
                        </div>
                    </div>
                </div>
                <div class="row wow fadeInUp" data-wow-duration="1.2s" id="question_coloumn">
                    @foreach ($questions as $question)
                    <div class="col-lg-4 text-center" id="question_<?php echo $question->slug ?>">
                        <div class="card" style="height: 260px">
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
                                    @php
                                    if(strlen($question->question) > 65){
                                        echo substr($question->question,0,64)."...";
                                    }
                                    else{
                                        echo $question->question;
                                    }
                                    @endphp
                                </h3>
                                <p>
                                    @php
                                        $byName = null;
                                        if(App\User::where('id',$question->user_id)->first()){
                                            $byName = App\User::where('id',$question->user_id)->first()->name;
                                        }
                                    @endphp
                                    By - {{$byName}}<br>
                                    Batch - {{$question->batch != null ? $question->batch : 'No Batch Given'}}
                                </p>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$question->slug}}" data-original-title="Preview" class="preview previewQuestion"><i class="far fa-eye"></i> Preview</a>

                                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$question->slug}}" data-original-title="Edit" class="edit editQuestion"><i class="fas fa-file-signature"></i> Edit</a>

                                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$question->slug}}" data-original-title="Delete" class="deleteQuestion"><i class="fas fa-trash-alt"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12 m-auto text-center">
                        <style>
                            .page-item.active .page-link{
                                background: #376678;
                                border-color: #376678;
                            }
                        </style>
                        {{ $questions->links() }}
                    </div>
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
                <p>
                    <b style="color: #376678; font-family: 'Roboto', sans-serif;">Question Marks:</b>
                    <span id="modal_question_marks" style="font-family: 'Roboto', sans-serif;"></span>
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
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background: #376678">

            <div class="modal-header" style="background: #376678; padding-left: 25px; padding-right:25px">
                <h5 class="modal-title" id="modelHeading2" style="color: white"></h5>
            </div>

            <div class="modal-body" style="background: white; padding-left: 25px; padding-right:25px">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <input type="hidden" name="slug" id="slug">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Question</b></label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="question" name="question" value="" required=""></textarea>
                        </div>
                    </div>
                    {{--  <div class="form-group">
                        <label for="question_marks" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Question Marks</b></label>
                        <div class="col-sm-12">
                            <input class="form-control" id="question_marks" name="question_marks" value="" required="">
                        </div>
                    </div>  --}}
                    <div class="form-group">
                        <label for="question_time" class="col-sm-12 control-label"><b style="color: #376678; font-family: 'Roboto', sans-serif;">Question Time (In Minutes)</b></label>
                        <div class="col-sm-12">
                            <input class="form-control" id="question_time" name="question_time" value="" placeholder="Different Time has given in Different Assessment" required="">
                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn rounded" id="saveBtn" style="color: white;background: #376678" value="create">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section("footer_js")

<script type="text/javascript">
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
                $('#modal_question_marks').html(data.data.marks);
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


        $('body').on('click', '.editQuestion', function () {
            var slug = $(this).data('id');
            $.get("{{ url('get/data/of/question') }}" +'/' + slug, function (data) {
                $('#modelHeading2').html("<b>Edit Question</b>");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel2').modal('show');
                $('#slug').val(data.data.slug);
                $('#question').val(data.data.question);
                $('#question_marks').val(data.data.marks);
                $('#question_time').val(data.data.time);
            })
        });


        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Updating..');
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ url('/update/question') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#productForm').trigger("reset");
                    $('#ajaxModel2').modal('hide');
                    location.reload(true);
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });


        $('body').on('click', '.deleteQuestion', function () {
            var slug = $(this).data('id');
            if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/delete/question') }}"+'/'+slug,
                    success: function (data) {
                        $("#question_"+slug).css("display","none");
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });


        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('/search/question')}}',
                data:{'search':$value},
                success:function(data){
                    $('#question_coloumn').html(data);
                }
            });
        })

    });
</script>
@endsection
