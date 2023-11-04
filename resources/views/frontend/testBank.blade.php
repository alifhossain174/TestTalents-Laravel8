@extends('frontend.master')

@section('header_css')
<link rel="stylesheet" href="{{url('frontend_assets')}}/css/style.css">
<link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
<style>
    .test_heading {
        padding-top: 100px;
    }

    .test_heading h1 {
        width: 70%;
        margin: auto;
    }

    .test_content {
        padding: 50px;
    }

    .test_bank_input {
        padding-bottom: 50px;
        position: relative;
    }

    .test_bank_input i {
        position: absolute;
        top: 8px;
        right: 30px;
        font-size: 18px;
        color: #376678;
    }
</style>
@endsection

@section('content')

<!-- Test Bank start -->
<section>
    <div class="test">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="test_heading text-center">
                        <h1>Measure your candidates on job skills, personality and fit</h1>
                        <p>
                            Our test archive employs a well-rounded approach in assessing an applicant's fit to your company from an aptitude assessment that matches the applicant's abilities to your ideal hire, to motivational and to personality evaluations. Watch as your employee satisfaction soars and your turnover rates take a nosedive when you choose TestTalents.
                        </p>
                    </div>
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

                    @foreach ($tests as $test)
                    <div class="col-lg-4 text-center" id="test_<?php echo $test->slug ?>">
                        <div class="card" style="height: 362px">
                            <div class="card-header text-left">
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
                            <div class="card-body text-left" style="background: white">
                                <h3>
                                    @php
                                    if(strlen($test->test_name) > 65){
                                        echo substr($test->test_name,0,64)."...";
                                    }
                                    else{
                                        echo $test->test_name;
                                    }
                                    @endphp
                                </h3>
                                <p style="margin-bottom: 20px; height: 160px;">
                                    <?php echo substr($test->test_summary,0,200)."...";?>
                                </p>
                                <div class="row">
                                    <div class="col-lg-6 pt-1">
                                        <b><i class="fas fa-history"></i></b> {{$test->test_time}} Min
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$test->slug}}" data-original-title="Preview" class="preview previewTest">Preview</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                {{ $tests->links() }}
            </div>
        </div>
    </div>
</section>
<!-- Test Bank end-->


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

        </div>

        <!-- Modal footer -->
        <div class="modal-footer" style="background: white">
            <button type="button" class="btn" style="background: #376678; color: white" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
</div>


    <!--Top Button Start-->
    <div class="top_btn wow bounceInRight">
        <i class="fas fa-arrow-up"></i>
    </div>
    <!--Top button End-->


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
            $.get("{{ url('/get/test/info') }}" +'/' + slug, function (data) {
                $('#modelHeading').html("<b>Test Preview</b>");
                $('#ajaxModel').modal('show');
                $('#modal_test_title').html(data.data.test_name);
                $('#modal_test_type').html(data.data.title);
                $('#modal_no_of_question').html(data.no_of_questions);
                $('#modal_test_level').html(data.test_level);
                var time_to_show = data.data.test_time + " Mins";
                $('#modal_test_time').html(time_to_show);
                $('#modal_test_summary').html(data.data.test_summary);
            })
        });

        $('#search').on('keyup',function(){
            $value=$(this).val();
            if($value != ''){
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('/search/test/public')}}',
                    data:{'search':$value},
                    success:function(data){
                        if(data == ''){
                            $(".pagination").css("display","none");
                            $('#question_coloumn').html(data);
                            // toastr.error("No Results Found")
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
                    url : '{{URL::to('/search/test/public')}}',
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

<script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
{!! Toastr::message() !!}

@endsection
