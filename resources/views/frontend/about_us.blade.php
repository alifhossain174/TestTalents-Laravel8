@extends('frontend.master')

@section('header_css')
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/about_us.css">
@endsection

@section('content')

<section>
    <div class="about_us_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_us_banner_text">
                        <h2>A GAME-CHANGING HIRING EXPERIENCE</h2>
                        <div class="banner_shape_1"></div>
                        <div class="banner_shape_2"></div>
                        <div class="banner_shape_3"></div>
                        <div class="banner_shape_4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="about_us_chose">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about_us_chose_image text-center">
                        <img src="{{url('frontend_assets')}}/images/chose_us.svg" alt="Choose Us" class="img-fluid w-75 m-auto">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about_us_chose_text">
                        <h2>Why Choose TestTalents ?</h2>
                        <p>
                            TestTalents’s analytics and AI-assisted recruiting enables hiring officers to make wiser decisions that can help avoid costly mistakes for the company down the road while promoting honest, transparent communication that ultimately nurtures beneficial relationships between the employees and the company.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="about_us_mission">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-2 order-lg-1 order-md-2">
                    <div class="about_us_mission_text text-center">
                        <h2>Our Mission</h2>
                        <p>
                            Our mission here at TestTalents is to help companies attract and engage skilled employees that will bring them forward to success and to create a positive working experience that will inspire, drive and nurture excellence.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 order-md-1">
                    <div class="about_us_mission_image text-center">
                        <img src="{{url('frontend_assets')}}/images/mission.svg" alt="mission" class="img-fluid w-75 m-auto">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="about_us_vision">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about_us_vision_image text-center">
                        <img src="{{url('frontend_assets')}}/images/vision.svg" alt="vision" class="img-fluid w-75 m-auto">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about_us_vision_text">
                        <h2>Our Vision</h2>
                        <p>
                            We believe that each person has skills and talents that when matched with the right roles, can make an amazing impact towards transforming companies that thrive and prosper.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="about_us_culture">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-2 order-lg-1 order-md-2">
                    <div class="about_us_culture_text text-center">
                        <h2>Our Culture</h2>
                        <p>
                            TestTalents aims to create a culture driven by diversity and connection where each person’s background can contribute invaluable insight and growth for everyone in the company.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 order-md-1">
                    <div class="about_us_culture_image text-center">
                        <img src="{{url('frontend_assets')}}/images/culture.svg" alt="culture" class="img-fluid m-auto">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section>
    <div class="about_us_presence">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about_us_presence_text text-center">
                        <h2>|| Our Presence ||</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="about_us_presence_image text-center">
                        <img src="{{url('frontend_assets')}}/images/MapChart_Map-compressed.jpg" alt="Map" class="img-fluid w-100">
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
