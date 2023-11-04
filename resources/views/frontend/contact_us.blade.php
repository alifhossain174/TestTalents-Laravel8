@extends('frontend.master')

@section('header_css')
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/contact_us.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">

    <style>
        .contact_us_banner {
            background-image: url('{{url('frontend_assets')}}/images/contact_us_4.jpg');
        }
    </style>
@endsection

@section('content')

<section>
    <div class="contact_us_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact_us_banner_text">
                        <h2><i class="far fa-envelope"></i> Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="contact_us_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact_us_from">
                        <div class="row">
                            <div class="col-lg-6 contact_us_image text-center">
                                <img src="{{url('frontend_assets')}}/images/contact_us.svg" alt="Contact" class="img-fluid">
                            </div>
                            <div class="col-lg-6 form_content">
                                <h2>Get In Touch</h2>
                                <form id="contactFrom">
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First Name *</label>
                                                <input type="text" value="@if(!Auth::guest()){{Auth::user()->name}}@endif" id="contact_first_name" name="first_name" placeholder="Enter Your First Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" id="contact_last_name" name="last_name" placeholder="Enter Your Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input type="text" value="@if(!Auth::guest()){{Auth::user()->email}}@endif" id="contact_email" name="email" placeholder="Enter Your Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone Number *</label>
                                                <input type="text" value="@if(!Auth::guest()){{Auth::user()->contact}}@endif" id="contact_mobile" name="mobile" placeholder="Enter Your Phone Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Message *</label>
                                                <input type="text" id="contact_msg" name="msg" placeholder="Enter Your Message">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <button id="submit" class="btn ounded pt-1 pb-1 pl-3 pr-3">Send <i class="fas fa-paper-plane"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Email Us On</label>
                                                <span class="d-block">admin@testtalents.com</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--Top Button Start-->
<div class="top_btn wow bounceInRight">
    <i class="fas fa-arrow-up"></i>
</div>
<!--Top button End-->

@endsection


@section('footer_js')

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submit').click(function (e) {
            e.preventDefault();

            var fname = $("#contact_first_name").val();
            var lname = $("#contact_last_name").val();
            var email = $("#contact_email").val();
            var phone = $("#contact_mobile").val();
            var msg = $("#contact_msg").val();

            if(fname == '' || email == '' || msg == '' || phone == ''){
                toastr.error("Please Fill Up Name, Email, Phone & Message");
                return false;
            }

            if(msg.length > 500){
                toastr.error("Sorry You Cannot Write More than 500 Character");
                return false;
            }

            $('#submit').html("Sending...");
            $.ajax({
                data: $('#contactFrom').serialize(),
                url: "{{ url('/send/email/for/contact') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#contactFrom').trigger("reset");
                    toastr.success("Received Your Message, Thanks.")
                    $('#submit').html("Submit <i class='fas fa-paper-plane'></i>");
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });

</script>

<script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
{!! Toastr::message() !!}

@endsection
