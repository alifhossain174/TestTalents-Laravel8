@extends('frontend.master')

@section('header_css')
<link rel="stylesheet" href="{{url('frontend_assets')}}/css/style.css">
@endsection

@section('content')

    <!-- Messenger Chat Plugin Code -->
    {{-- <div id="fb-root"></div> --}}

    <!-- Your Chat Plugin code -->
    {{-- <div id="fb-customer-chat" class="fb-customerchat"></div> --}}

    <script>
        // var chatbox = document.getElementById('fb-customer-chat');
        // chatbox.setAttribute("page_id", "100524792265514");
        // chatbox.setAttribute("attribution", "biz_inbox");

        // window.fbAsyncInit = function() {
        //     FB.init({
        //     xfbml            : true,
        //     version          : 'v11.0'
        //     });
        // };

        // (function(d, s, id) {
        //     var js, fjs = d.getElementsByTagName(s)[0];
        //     if (d.getElementById(id)) return;
        //     js = d.createElement(s); js.id = id;
        //     js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        //     fjs.parentNode.insertBefore(js, fjs);
        // }(document, 'script', 'facebook-jssdk'));
    </script>


    <!--banner part start-->
    <section>
        <div class="banner_part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="banner_text text-center">
                            <h1 class="wow fadeInRight banner_heading_1" data-wow-duration="1.2s">Challenge the Best.</h1>
                            <h1 class="wow fadeInRight banner_heading_2" data-wow-duration="1.2s">Fast Results. Flexible Test.</h1>
                            <p class="wow fadeInRight" data-wow-duration="1.2s">
                                Our AI Software will help to find the quality candidates and to take worthy decision.
                            </p>
                            <a href="{{url('/login')}}" class="banner_button_1 wow fadeInRight" data-wow-duration="1.2s">Try For Free</a>
                            <a href="https://calendly.com/mdmoniruzzamanmonir" target="_blank" class="banner_button_2 wow fadeInRight" data-wow-duration="1.2s">Book a Demo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--banner part end-->


    <!--top part start-->
    <section>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top_text text-center">
                            <h1>Find the Best Candidate</h1>
                            <p class="w-75 m-auto">
                                Want to end the stress, frustration, and losses associated with hiring the wrong applicant? Because investing precious time, money, and energy on a wrong hire is downright disappointing and demoralizing. When it doesn’t need to be. Find the perfect match efficiently and effortlessly with TestTalents’s customizable job test.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="top_box">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <h3>Test Real Skills</h3>
                            <p>
                                TestTalents’s comprehensive skill analysis ensures that applicants are screened against relevant job requirements so that you get nothing short of top performance on the job for happier customers and high-achieving companies.
                            </p>
                            <a href="{{url('/test/bank')}}">Details</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top_box">
                            <i class="fa fa-clock" aria-hidden="true" style="color: #37A000"></i>
                            <h3>Choose Quality over Quantity </h3>
                            <p>
                                With an outstanding 1200 test bank and highly customizable skill tests, TestTalents chooses only the finest candidates to make it to the interview process so that you can do more of the things that matter AND you don’t miss out on high-quality applicants.
                            </p>
                            <a href="{{url('/test/bank')}}">Details</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top_box">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <h3>Best Match Guaranteed</h3>
                            <p>
                                Find the right person for the job with Enterprise Application skills and Individualized Premium skill matching. So that you can build a team of experts who would drive the company forward.
                            </p>
                            <a href="{{url('/test/bank')}}">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--top part end-->


    <!--top2 part start-->
    <section>
        <div class="top2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="top_box">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <h3>Ultimate Skills Repository</h3>
                            <p>
                                With a whopping 2000+ skills cloud, the sky's the limit to the customizations you can do so that you can personalize each job requirement according to the role you need.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top_box">
                            <i class="fa fa-clock" aria-hidden="true" style="color: #37A000"></i>
                            <h3>Real-Time Interviews</h3>
                            <p>
                                Live video interviews assess your applicants from every angle so that you can make fully informed decisions before you hire.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top_box">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <h3>Fastest Custom Assessments </h3>
                            <p>
                                Quick, expert skills assessments for instant candidate evaluation so that you can spend quality time with quality people because great companies are made of excellent people.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top_box">
                            <i class="fa fa-wrench" aria-hidden="true"></i>
                            <h3>AI-Enhanced Monitoring</h3>
                            <p>
                                AI-monitored content preserves application integrity to ensure safe and secure assessments free from cheating.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top_box">
                            <i class="fa fa-bar-chart" aria-hidden="true" style="color: #37A000"></i>
                            <h3>AI-powered Insights </h3>
                            <p>
                                With AI-guided proficiency reports, you can eliminate wrong hires and identify the best fit.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top_box">
                            <i class="fa fa-envelope-open" aria-hidden="true"></i>
                            <h3>Round-The-clock Support </h3>
                            <p>
                                Get help above and beyond what you need however you want with 24/7 chat, email and phone support
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--top2 part end-->


    <!--resume part start-->
    <section>
        <div class="resume">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="resume_text">
                            <h2>Swift, Efficient Resume Reviews</h2>
                            <p>
                                Going through hundreds of applications is a thing of the past when you use TestTalents as the first step in your hiring process. A skill test linked to your job post evaluates all potential applicants in minutes (not hours) giving you a shortlist of highly qualified candidates, significantly reducing hiring time.
                            </p>
                            <p>
                                <i class="fas fa-umbrella-beach" aria-hidden="true"></i>
                                <span>Save Time </span>
                            </p>
                            <p>
                                No more time wasted screening out hundreds of unqualified candidates.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="resume_img">
                            <img src="{{url('frontend_assets')}}/images/resume1.jpg" alt="Resume1" class="img-fluid w-75 resume1">
                            <img src="{{url('frontend_assets')}}/images/resume2.jpg" alt="Resume2" class="img-fluid w-75 resume2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--resume part end-->


    <!-- Test Bank start -->
    <section>
        <div class="test">
            <div class="container" style="width: 85%">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="test_heading text-center">
                            <h1>|| Our Test Archive .</h1>
                            <p>
                                Our test archive employs a well-rounded approach in assessing an applicant’s fit to your company from an aptitude assessment that matches the applicants’ abilities to your ideal hire, to motivational and to personality evaluations. Watch as your employee satisfaction soars and your turnover rates take a nosedive when you choose TestTalents.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="test_content">

                    <div class="row wow fadeInUp test_slider" data-wow-duration="1.2s">

                        @foreach ($tests as $test)
                        <div class="col-lg-12 text-center" id="test_<?php echo $test->slug ?>">
                            <div class="card" style="width: 90%;height: 345px">
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
                                <div class="card-body text-left bg-white" style="background-color: white !important">
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
                                        <div class="col-lg-6 col-6 pt-1">
                                            <b><i class="fas fa-history"></i></b> {{$test->test_time}} Min
                                        </div>
                                        <div class="col-lg-6 col-6 text-right">
                                            <a href="{{url('/test/bank')}}" data-original-title="Preview" class="preview previewTest">View All</a>
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


    <!--testimonial Start-->
    <section>
        <div class="testimonial">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="test_heading text-center">
                            <h1>|| TestiMonials .</h1>
                        </div>
                    </div>
                </div>
                <div class="testimonial_content">
                    <div class="row testimonial_slider">
                        <div class="col-lg-12">
                            <div class="test_details wow fadeInUp" data-wow-duration="1.2s">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <img src="{{url('frontend_assets')}}/images/resume1.jpg" alt="Testimonial" class="testimonial_image">
                                    </div>
                                    <div class="col-lg-10">
                                        <p>
                                            “Remote exams or online tests help recruiters or examiners to examine the candidate's technical or skilled-based knowledge on quality hiring decisions. This AI-based online examination system makes the result available at minimum time and cost. The results are more accurate, instant, and bias-free.”
                                        </p>
                                        <h4>Monir Zaman</h4>
                                        <span>HR Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="test_details wow fadeInUp" data-wow-duration="1.2s">
                                <div class="row">
                                    <div class="col-lg-2 bg-ranger">
                                        <img src="{{url('frontend_assets')}}/images/resume1.jpg" alt="Testimonial" class="testimonial_image">
                                    </div>
                                    <div class="col-lg-10">
                                        <p>
                                            “Remote exams or online tests help recruiters or examiners to examine the candidate's technical or skilled-based knowledge on quality hiring decisions. This AI-based online examination system makes the result available at minimum time and cost. The results are more accurate, instant, and bias-free”
                                        </p>
                                        <h4>Monir Zaman</h4>
                                        <span>HR Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="test_details wow fadeInUp" data-wow-duration="1.2s">
                                <div class="row">
                                    <div class="col-lg-2 bg-ranger">
                                        <img src="{{url('frontend_assets')}}/images/resume1.jpg" alt="Testimonial" class="testimonial_image">
                                    </div>
                                    <div class="col-lg-10">
                                        <p>
                                            “Remote exams or online tests help recruiters or examiners to examine the candidate's technical or skilled-based knowledge on quality hiring decisions. This AI-based online examination system makes the result available at minimum time and cost. The results are more accurate, instant, and bias-free.”
                                        </p>
                                        <h4>Monir Zaman</h4>
                                        <span>HR Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--testimonial End-->


    <!--Counter CSS Start-->
    <section id="counter_start">
        <div class="counter_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="c_content">
                            <i class="fas fa-heart"></i>
                            <h3 class="counter">35</h3>
                            <h5>Happy Clients</h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="c_content">
                            <i class="fas fa-tasks"></i>
                            <h3 class="counter">36</h3>
                            <h5>Total Tests</h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="c_content">
                            <i class="fas fa-coffee"></i>
                            <h3 class="counter">42</h3>
                            <h5>Assessed Candidates</h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="c_content">
                            <i class="fas fa-comment-dollar"></i>
                            <h3 class="counter">55</h3>
                            <h5>Lovely Feedbacks</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Counter CSS End-->

@endsection
