@extends('backend.master')

@section("header_css")
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
@endsection

@section('content')

    <form action="{{url('save/assesment/secondstep')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- backend navigation start-->
        <section>
            <div class="backend_navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="navigation_title">
                                <h3>Add Test (Step-2)</h3>
                                <b>Attach maximum 5 tests to this Assement</b>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="navigation_item pt-2">
                                <ul>
                                    <li class="active">
                                        <button type="submit" style="cursor: pointer">Next Step <i class="fas fa-arrow-right"></i></button>
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
                                        <a class="btn text-white" style="background: #226679;cursor:default">Step 2 : Select Test</a> <i class="fas fa-arrow-right" style="color: #226679"></i>
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-dark text-white" type="submit" style="cursor: pointer;box-shadow: 5px 5px 10px gray">Step 3 : Add Question</button> <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn btn-dark text-white" style="cursor:default">Step 4 : Review & Configure</a>
                                    </div>
                                </div>


                                <div class="col-lg-12 border" style="height: 50px">
                                    <div class="row" id="testBox">

                                    </div>
                                </div>
                                <span style="color: gray; font-size:13px">* Your assessment can include up to 5 tests. Browse the test library and add the most relevant tests</span>

                                <section>
                                    <div class="test" style="background: transparent">
                                        <div class="test_content">
                                            <div class="test_bank_input">
                                                <div class="row">
                                                    <div class="col-lg-6 m-auto">
                                                        <i class="fas fa-search"></i>
                                                        <input type="text" name="search" id="search" class="form-control" placeholder="Search Test to Attach with Assesment">
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
                                                            <h3 id="test_slug_{{$test->slug}}">
                                                                @php
                                                                if(strlen($test->test_name) > 65){
                                                                    echo substr($test->test_name,0,64)."...";
                                                                }
                                                                else{
                                                                    echo $test->test_name;
                                                                }
                                                                @endphp
                                                            </h3>
                                                            <p style="margin-bottom: 20px; height: 148px;">
                                                                <?php echo substr($test->test_summary,0,200)."...";?>
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-lg-12 text-center">
                                                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$test->slug}}" data-original-title="Preview" class="preview previewTest"><i class="far fa-eye"></i> Preview</a>

                                                                    <a href="javascript:void(0)" id="{{$test->slug}}"  onclick="addTestToTheAssesment(this.id)"><i class="fas fa-plus-circle"></i> Add to Assesment</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
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
@endsection


@section('footer_js')

<script type="text/javascript">

    function addTestToTheAssesment(value){

        var duplicate = 0;
        $( "input.tests" ).each(function( index, element ) {
            if ( $( this ).val() == value ) {
                alert("Already Added");
                duplicate++;
                return false;
            }
        });

        if(duplicate == 0){
            var title = $("#test_slug_"+value).html();
            var serial = Number($('#testBox .col').length)+1;
            if(serial <= 5){
                var str = "<div style='background:#226679;line-height:50px;color:white;border-radius:5px;position:relative;overflow:hidden; height: 50px' id='test_no_"+serial+"' class='col ml-1 mr-1'>"+title+"<input type='hidden' class='tests' value='"+value+"' name='tests[]'> <a href='javascript:void(0)' style='position:absolute;top:-15px;right:5px' onclick='deleteTestFromAssesment("+serial+")' class='text-white'><i class='fas fa-times'></i></a></div>"
                $("#testBox").append(str);
                toastr.success("Test Added");
            }
            else{
                alert("Cannot Add More than 5 Tests");
            }
        }
    }

    function deleteTestFromAssesment(id){
        $("#test_no_"+id).remove();
    }

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

        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('/search/test/to/add/with/assesment')}}',
                data:{'search':$value},
                success:function(data){
                    $('#question_coloumn').html(data);
                }
            });
        })

    });
</script>

<script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
{!! Toastr::message() !!}

@endsection
