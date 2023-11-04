@extends('frontend.master')

@section('header_css')
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/pricing.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">
@endsection

@section('content')

<section>
    <div class="container">
        <div class="test">
            <div class="row">
                <div class="col-lg-12 pt-5">
                    <div class="test_heading text-center pt-5">
                        <h1>Build a Winning Team <br> With the Right Plan.</h1>
                    </div>
                </div>
            </div>
            <div class="test_content">
                <div class="row">

                    <div class="col-lg-4 text-center">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-coins"></i>
                                <h1 class="card_head mt-3 mb-2"><b>Business</b></h1>
                                <p class="pl-2 pr-2">Great for Bigger teams looking to hire best talent, faster.</p>
                                <h3 class="plan"><b>450 USD /Month</b></h3>
                                <a href="{{url('/plan/billing')}}">Buy Now</a>
                                <hr>
                                <div class="price_content">
                                    <div class="row">
                                        <div class="col-lg-12 text-left">
                                            <ul class="package_features">
                                                <li>500 Assessment Invitations Per Year</li>
                                                <li>$1 for an extra Invitation</li>
                                                <li>Standard Test Library</li>
                                                <li>Custom Test Configuration</li>
                                                <li>Realistic Simulation Tests</li>
                                                <li>Validated Content</li>
                                                <li>24/7 Live Support</li>
                                                <li>Custom Content with Editor</li>
                                                <li>Customized Branding</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 text-center">
                        <div class="card mid_level">
                            <div class="card-body text-center">
                                <i class="fas fa-money-bill-alt"></i>
                                <h1 class="card_head mt-3 mb-2"><b>Premium </b></h1>
                                <p class="pl-2 pr-2">Great for Medium teams looking to hire best talent, faster.</p>
                                <h3 class="plan"><b>100 USD /Month</b></h3>
                                <a href="{{url('/plan/billing')}}">Buy Now</a>
                                <hr>
                                <div class="price_content">
                                    <div class="row">
                                        <div class="col-lg-12 text-left">
                                            <ul class="package_features">
                                                <li>100 Assessment Invitations Per Year </li>
                                                <li>$1 for an extra Invitation</li>
                                                <li>Standard Test Library</li>
                                                <li>Custom Test Configuration</li>
                                                <li>Realistic Simulation Tests</li>
                                                <li>Validated Content</li>
                                                <li>24/7 Live Support</li>
                                                <li>Custom Content with Editor</li>
                                                <li>Customized Branding</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 text-center">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-hourglass-start"></i>
                                <h1 class="card_head mt-3 mb-2"><b>Basic</b></h1>
                                <p class="pl-2 pr-2">Its Free, Try out skills-based hiring From Now.</p>
                                <h3 class="plan"><b>0 USD /Month</b></h3>
                                <a href="{{url('/plan/billing')}}">Try it Now</a>
                                <hr>
                                <div class="price_content">
                                    <div class="row">
                                        <div class="col-lg-12 text-left">
                                            <ul class="package_features">
                                                <li>5 Assessment Invitations Per Month</li>
                                                <li>Change Plan for extra Candidates</li>
                                                <li>Standard Test Library</li>
                                                <li>Custom Test Configuration</li>
                                                <li>Realistic Simulation Tests</li>
                                                <li>Validated Content</li>
                                                <li>24/7 Live Support</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="second">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-3">
                <h1><b>Unsure which plan to choose ?</b></h1>
                <p>We are always here to help you. Just write your query with contact information and hit that Get In Touch button. We will catch you soon. </p>
            </div>
            <div class="col-lg-6">
                <form id="get_in_touch_form">

                    <input type="text" name="name" id="get_in_touch_name" value="@if(!Auth::guest()){{Auth::user()->name}}@endif" class="form-control mb-3" placeholder="Write Your Full Name">
                    <input type="Email" name="email" id="get_in_touch_email" value="@if(!Auth::guest()){{Auth::user()->email}}@endif" class="form-control mb-3" placeholder="Write Your Email">

                    <textarea name="msg" id="get_in_touch_msg" class="form-control mb-3">Hello...!!</textarea>
                    <button type="button" class="btn m-0" id="get_in_touch_btn">Get In Touch</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="third">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 pt-3">
                <h2><b>Frequently Asked Questions</b></h2>
            </div>
            <div class="col-lg-9">
                <ul>
                    <li>
                        <h4 data-toggle="collapse" href="#multiCollapseExample8" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample8"><b>What's the difference between an assessment and a test ?</b><i class="fas fa-eye"></i></h4>
                        <p class="collapse multi-collapse" id="multiCollapseExample8">An assessment is the total package of tests and custom questions that you put together to evaluate your candidates. Each individual test within an assessment is designed to test something specific, such as a job skill or language. An assessment can consist of up to 5 tests and 10 custom questions. You can have candidates respond to your custom questions in several ways, such as with a personalized video.</p>
                    </li>
                    <hr>
                    <li>
                        <h4 data-toggle="collapse" href="#multiCollapseExample4" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample4"><b>Does your service include role-based access control ?</b><i class="fas fa-eye"></i></h4>
                        <p class="collapse multi-collapse" id="multiCollapseExample4">Yes, our service includes RBAC so that you can regulate who can access or edit your resources. Based on role, we have access restrictions such as read-only, no access, read-write, etc.</p>
                    </li>
                    <hr>
                    <li>
                        <h4 data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                            <b>What payment methods do you accept ?</b>
                            <i class="fas fa-eye"></i>
                        </h4>
                        <p class="collapse multi-collapse" id="multiCollapseExample1">
                            We accept all major Credit Cards, Debit Cards, Internet Banking and Checks. All the pricing
                            mentioned is in BDT.
                        </p>
                    </li>
                    <hr>
                    <li>
                        <h4 data-toggle="collapse" href="#multiCollapseExample6" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample6"><b>How much do I save with a yearly plan ?</b><i class="fas fa-eye"></i></h4>
                        <p class="collapse multi-collapse" id="multiCollapseExample6">Yes! When you sign up for a yearly subscription, you can save a considerable amount of money a year (or more) compared to a monthly plan. You can directly compare prices yourself by toggling the yearly/monthly button above.</p>
                    </li>

                    <hr>
                    <li>
                        <h4 data-toggle="collapse"
                        href="#multiCollapseExample2" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample2"><b>How do I create a custom test ?</b><i class="fas fa-eye"></i></h4>
                        <p class="collapse multi-collapse" id="multiCollapseExample2">You can create a custom test with the help of TestTalents’s support team or by yourself by identifying your requirements for the role and the job description.</p>
                    </li>
                    <hr>

                    <li>
                        <h4 data-toggle="collapse" href="#multiCollapseExample7" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample7"><b>How does your free trial work ?</b><i class="fas fa-eye"></i></h4>
                        <p class="collapse multi-collapse" id="multiCollapseExample7">With our free trial you get full access to our service along with 3 free credits per month. Free credits are used to invite candidates to your assessment and are valid for the whole year. You can create and customize an assessment, send it to 3 candidates, then analyze the results—all for free.</p>
                    </li>
                    <hr>
                    <li>
                        <h4 data-toggle="collapse"
                        href="#multiCollapseExample3" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample3"><b>Who gets to access my data ?</b><i class="fas fa-eye"></i></h4>
                        <p class="collapse multi-collapse" id="multiCollapseExample3">All your data are safe and secure and could only be accessed by You.</p>
                    </li>
                    <hr>
                    <li>
                        <h4 data-toggle="collapse" href="#multiCollapseExample5" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample5"><b>What are your pricing plans ?</b><i class="fas fa-eye"></i></h4>
                        <p class="collapse multi-collapse" id="multiCollapseExample5">We have 3 pricing plans based on your needs: Basic, Premium and business which you could avail as a monthly or yearly subscription. Each plan varies on the no. of candidates you can test. However, if you need to test above the set number, you can continue to test them for BDT 100 each.</p>
                    </li>
                    <hr>
                    <li>
                        <h4 data-toggle="collapse" href="#multiCollapseExample9" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample9"><b>How can you help me ?</b><i class="fas fa-eye"></i></h4>
                        <p class="collapse multi-collapse" id="multiCollapseExample9">Our team is dedicated to help get your business running smoothly. That’s why after you sign up, we guide you with each step of setting up your TestTalents account. For any further questions, you can always drop us a message via email, chat or give us a call at *add phone number here*. You may also want to check  our comprehensive Help and Inspiration center for detailed manuals which may be of assistance to you.</p>
                    </li>
                    <hr>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="fourth">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="d-inline pt-2 pr-3"><b>Want to know more ?</b></h1> <button type="button" style="margin-top: -15px" class="btn">Watch the demo</button>
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

        $('#get_in_touch_btn').click(function (e) {
            e.preventDefault();

            var name = $("#get_in_touch_name").val();
            var email = $("#get_in_touch_email").val();
            var msg = $("#get_in_touch_msg").val();

            if(name == '' || email == '' || msg == ''){
                toastr.error("Please Fill Up Name, Email & Message");
                return false;
            }

            if(msg.length > 500){
                toastr.error("Sorry You Cannot Write More than 500 Character");
                return false;
            }

            $('#get_in_touch_btn').html("Sending...");
            $.ajax({
                data: $('#get_in_touch_form').serialize(),
                url: "{{ url('/send/email/for/support') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#get_in_touch_form').trigger("reset");
                    toastr.success("We Have Received Your Request ! Thanks")
                    $('#get_in_touch_btn').html("Get In Touch");
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
