@extends('backend.master')

@section("header_css")
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
@endsection

@section("header_js")
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
@endsection

@section("content")
<!-- Test library start -->
<section>
    <div class="test">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="test_heading text-center">
                        {{-- <h1>Test Bank</h1> --}}
                        <p class="mt-2">
                            <a href="{{url("/add/test/page")}}" style="color: white; padding: 5px 20px !important; box-shadow: 5px 5px 10px gray; text-shadow: 1px 1px 2px black; background-color: #226679; font-weight: 600" class="btn rounded d-inline-block"><i class="fas fa-plus-circle"></i> Build Test</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="test_content">
                <div class="test_bank_input">
                    <div class="row">
                        <div class="col-lg-6 m-auto">
                            <i class="fas fa-search"></i>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search for Test Here">
                        </div>
                    </div>
                </div>
                <div class="row wow fadeInUp" data-wow-duration="1.2s" id="question_coloumn">
                    @foreach ($tests as $test)
                    <div class="col-lg-4 text-center" id="test_<?php echo $test->slug ?>">
                        <div class="card" style="height: 362px">
                            <div class="card-header text-left">
                                <div class="row p-0 m-0">
                                    <div class="col-lg-6 p-0 m-0">
                                        <h3>
                                            @if($test->test_level == 1)
                                                <i class="fas fa-bars"></i> Easy
                                            @elseif($test->test_level == 2)
                                                <i class="fas fa-chart-bar"></i> Intermediate
                                            @elseif($test->test_level == 3)
                                                <i class="fas fa-qrcode"></i> Expert
                                            @endif
                                        <h3>
                                    </div>
                                    <div class="col-lg-6 p-0 m-0 text-right text-white">
                                        @if($test->user_type != 1)
                                        <h3 style="font-size: 17px"><i class="far fa-user-circle"></i></h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-left bg-white" style="background-color: white !important">
                                <h3>
                                    @php
                                    if(strlen($test->test_name) > 35){
                                        echo substr($test->test_name,0,34)."...";
                                    }
                                    else{
                                        echo $test->test_name;
                                    }
                                    @endphp
                                </h3>
                                <p style="margin-bottom: 20px; height: 148px;">
                                    @php
                                        if($test->user_id == Auth::user()->id){
                                            echo "This is a customized test created by <span style='font-weight: 500;'>".$test->user_name."</span> on <span style='font-weight: 500;'>".$test->test_type_title."</span>";
                                        }
                                        else{
                                            echo substr($test->test_summary,0,200)."...";
                                        }
                                    @endphp
                                </p>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$test->slug}}" data-original-title="Preview" class="preview previewTest"><i class="far fa-eye"></i> Preview</a>
                                        @if(Auth::user()->id == $test->user_id)
                                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$test->slug}}" data-original-title="Edit" class="edit editTest"><i class="fas fa-file-signature"></i> Edit</a>
                                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$test->slug}}" data-original-title="Delete" class="deleteTest"><i class="fas fa-trash-alt"></i> Delete</a>
                                        @endif
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
                        {{ $tests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Test library end-->


<!-- Preview Modal -->
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background: #376678">

        <!-- Modal Header -->
        <div class="modal-header" style="background: #376678; padding-left: 25px; padding-right:25px">
            <h5 class="modal-title" id="modelHeading" style="color: white"></h5>
        </div>

         <!-- Modal body -->
         <style>
            .modal-body ol,ul{
                list-style: square;
                padding-left: 16px;
            }

            .modal-body ol,ul li{
                font-family: 'Roboto', sans-serif;
                font-weight: 400;
                font-size: 15px;
            }
            .modal-body span{
                font-family: 'Roboto', sans-serif;
                font-weight: 400;
                font-size: 15px;
                text-align: justify
            }
            .modal-body h5{
                color: #376678;
                font-family: 'Roboto', sans-serif;
                font-weight: 600;
                font-size: 22px;
            }
            .modal-body i{
                color: #1D4354;
                font-size: 22px;
                font-weight: 600;
                margin-bottom: 10px
            }
            .modal-body h6{
                color: #1D4354;
                font-size: 18px;
                font-weight: 700;
                margin-bottom: 3px
            }
            .modal-body span.description{
                font-size: 15px;
                font-weight: 600;
            }

            .modal-body b{
                color: #1D4354;
                font-size: 18px;
                font-weight: 700;
            }
        </style>

        <div class="modal-body" style="background: white; padding-left: 25px; padding-right:25px">
            <h5 id="modal_test_title" class="mt-3 mb-5"></h5>
            <div class="row mb-4">
                <div class="col-3 border-right text-center">
                    <i class="fas fa-tasks"></i>
                    <h6>Type</h6>
                    <span id="modal_test_type" class="description"></span>
                </div>
                <div class="col-3 border-right text-center">
                    <i class="far fa-clock"></i>
                    <h6>Time</h6>
                    <span id="modal_test_time" class="description"></span>
                </div>
                <div class="col-3 border-right text-center">
                    <i class="fas fa-signal"></i>
                    <h6>Level</h6>
                    <span id="modal_test_level" class="description"></span>
                </div>
                <div class="col-3 text-center">
                    <i class="far fa-question-circle"></i>
                    <h6>Questions</h6>
                    <span id="modal_no_of_question" class="description"></span>
                </div>
            </div>

            <div>
                <span id="modal_test_summary"></span>
            </div>

            <br>
            <p id="question_set">
                <b>Questions of this Test :</b>
                <span id="modal_question_of_this_test"></span>
            </p>
            <br>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer" style="background: white">
            <button type="button" class="btn" style="background: #376678; color: white" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="ajaxModel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background: #376678">

        <!-- Modal Header -->
        <div class="modal-header" style="background: #376678; padding-left: 25px; padding-right:25px">
            <h5 class="modal-title" id="modelHeading2" style="color: white"></h5>
        </div>

        <!-- Modal body -->
        <style>
            .modal-body p b{
                color: #376678;
                font-family: 'Roboto', sans-serif;
                font-weight: 600;
                font-size: 16px;
            }
        </style>

        <div class="modal-body" style="background: white; padding-left: 25px; padding-right:25px">
            <form id="productForm" name="productForm" class="form-horizontal">
                <input type="hidden" name="test_slug" id="modal_input_test_slug" value="">
                <p>
                    <b>Test Title :</b>
                    <input type="text" name="test_name" class="form-control" id="modal_input_test_title" required>
                </p>
                <br>
                <div class="row">
                    <div class="col-4">
                        <p>
                            <b>Test Type :</b>
                            <select name="test_type" class="form-control" id="modal_input_test_type" required>

                            </select>
                        </p>
                    </div>
                    <div class="col-4">
                        <p>
                            <b>Test Time (In Minute) :</b>
                            <input type="text" name="test_time" class="form-control" id="modal_input_test_time" required>
                        </p>
                    </div>
                    <div class="col-4">
                        <p>
                            <b>Test Level :</b>
                            <select name="test_level" class="form-control" id="modal_input_test_level" required>

                            </select>
                        </p>
                    </div>
                    {{--  <div class="col-4">
                        <p>
                            <b>Test Audiance :</b>
                            <input type="text" name="test_audience" class="form-control" id="modal_input_test_audience" required>
                        </p>
                    </div>  --}}
                </div>
                <br>
                <p>
                    <b>Test Summary :</b>
                    <textarea name="test_summary" class="form-control" id="modal_input_test_summary" required></textarea>
                </p>
                <br>
                {{--
                <p>
                    <b>Test Description :</b>
                    <textarea name="test_description" class="form-control" id="modal_input_test_description" required></textarea>
                </p>
                <hr> --}}
                <div class="col-sm-12 text-right p-0">
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

        $('body').on('click', '.previewTest', function () {
            var slug = $(this).data('id');
            $.get("{{ url('get/data/of/test') }}" +'/' + slug, function (data) {
                $('#modelHeading').html("<b>Preview Test</b>");
                $('#ajaxModel').modal('show');
                $('#modal_test_title').html(data.data.test_name);
                $('#modal_test_type').html(data.data.title);
                $('#modal_no_of_question').html(data.no_of_questions);
                $('#modal_test_level').html(data.test_level);
                var time_to_show = data.data.test_time + " Mins";
                $('#modal_test_time').html(time_to_show);
                $('#modal_test_created_by').html(data.data.user_name);
                // $('#modal_test_audiance').html(data.data.test_audience);
                // $('#modal_test_author_name').html(data.data.test_author_name);
                $('#modal_test_summary').html(data.data.test_summary);
                // $('#modal_test_description').html(data.data.test_description);
                // $('#modal_test_author_description').html(data.data.test_author_description);
                if(data.str == null){
                    $("#question_set").css("display", "none");
                }
                else{
                    $("#question_set").css("display", "block");
                    $('#modal_question_of_this_test').html(data.str);
                }

                // if(data.data.test_author_image != null){
                //     var base_url = window.location.origin;
                //     var url = base_url+"/"+data.data.test_author_image;
                //     $("#modal_test_author_image img").attr("src", url);
                // }
            })
        });


        $('body').on('click', '.editTest', function () {
            var slug = $(this).data('id');
            $.get("{{ url('get/data/of/test') }}" +'/' + slug, function (data) {
                $('#modelHeading2').html("<b>Edit Test</b>");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel2').modal('show');
                $('#modal_input_test_slug').val(data.data.slug);
                $('#modal_input_test_title').val(data.data.test_name);
                $('#modal_input_test_type').html(data.test_types);
                $('#modal_input_test_level').html(data.test_level_lists);
                $('#modal_input_test_time').val(data.data.test_time);
                $('#modal_input_test_audience').val(data.data.test_audience);
                $('#modal_input_test_summary').val(data.data.test_summary);
                // $('#modal_input_test_description').val(data.data.test_description);
                $('#modal_input_test_author_name').val(data.data.test_author_name);
                // $('#modal_input_test_author_description').val(data.data.test_author_description);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Updating..');
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ url('/update/test') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#productForm').trigger("reset");
                    $('#ajaxModel2').modal('hide');
                    $('#saveBtn').html('Update');
                    toastr.success("Test Updated Successfully");
                    // location.reload(true);
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Some Thing Went Wrong...');
                }
            });
        });

        $('body').on('click', '.deleteTest', function () {
            var slug = $(this).data('id');
            if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "GET",
                    url: "{{ url('/delete/test') }}"+'/'+slug,
                    success: function (data) {
                        $("#test_"+slug).css("display","none");
                        toastr.error("Deleted Successfully")
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        $('#search').on('keyup',function(){
            $value=$(this).val();
            if($value != ''){
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('/search/test')}}',
                    data:{'search':$value},
                    success:function(data){
                        if(data == ''){
                            $(".pagination").css("display","none");
                            $('#question_coloumn').html(data);
                            toastr.error("No Results Found")
                            return false;
                        } else {
                            $(".pagination").css("display","none");
                            $('#question_coloumn').html(data);
                        }
                    }
                });
            } else {
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('/search/test')}}',
                    data:{'search':$value},
                    success:function(data){
                        $('#question_coloumn').html(data);
                        $(".pagination").css("display","flex");
                    }
                });
            }

        })

    });
</script>

{{--  <script type="text/javascript">
    CKEDITOR.replace('test_summary', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>  --}}

{{--  <script type="text/javascript">
    CKEDITOR.replace('test_description', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>  --}}

{{--  <script type="text/javascript">
    CKEDITOR.replace('test_author_description', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>  --}}

<script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
{!! Toastr::message() !!}

@endsection
