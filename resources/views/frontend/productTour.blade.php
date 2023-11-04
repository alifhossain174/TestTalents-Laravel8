@extends('frontend.master')

@section('header_css')
<link rel="stylesheet" href="{{url('frontend_assets')}}/css/style.css">
@endsection

@section('content')

    <!--banner part start-->
    <section>
        <div class="banner_part ">
            <div class="banner_1 ">
                <div class="container-fluid ">
                    <div class="row ">
                        <div class="col-lg-6 p-0">
                            <div class="banner_text">
                                <h1 class="wow fadeInRight" data-wow-duration="1.2s">Hire the best.</h1>
                                <h1 class="wow fadeInRight" data-wow-duration="1.2s">No bias. No stress.</h1>
                                <p class="wow fadeInRight" data-wow-duration="1.2s">
                                    Our screening tests identify the best candidates and make your hiring decisions faster, easier, and bias-free.
                                </p>
                                <a href="#" class="banner_button_1 wow fadeInRight" data-wow-duration="1.2s">Try For Free</a>
                            </div>
                        </div>
                        <div class="col-lg-6 p-0">
                            <div class="banner_img">
                                <img src="{{url('frontend_assets')}}/images/girl.png" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--banner part end-->

    <!--Our Service Part Start-->
    <section id="service">
        <div class="our_service">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header_section text-center">
                            <h1>About Our Service</h1>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Loremsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service_content">
                <div class="container">
                    <img src="{{url('frontend_assets')}}/images/dotted_vertical_line.png" alt="" class="img-fluid dotted_bg d-none d-lg-block d-md-block">

                    <div class="service_slider">


                        <div class="service_slide">
                            <div class="row">
                                <div class="col-lg-5 col-12 text-right">
                                    <h4 class="text-uppercase">Web Design</h4>
                                </div>
                                <div class="col-lg-2 col-12 middle_icon">
                                    <div class="service_icon">
                                        <img src="{{url('frontend_assets')}}/images/service_icon_1.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="service_text arrow_left">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typtting industry. Lorem Ipsum has been the industry's standard y text ever since the 1500s, when an unknown printer took a galleye and scrambled it to make a type specimen book. It has surve nothing
                                            is impossible centuries.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="service_slide">
                            <div class="row">
                                <div class="col-lg-5 text-right">
                                    <div class="service_text arrow_right">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typtting industry. Lorem Ipsum has been the industry's standard y text ever since the 1500s, when an unknown printer took a galleye and scrambled it to make a type specimen book. It has surve nothing
                                            is impossible centuries.
                                        </p>
                                    </div>

                                </div>
                                <div class="col-lg-2 middle_icon">
                                    <div class="service_icon">
                                        <img src="{{url('frontend_assets')}}/images/service_icon_2.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <h4 class="text-uppercase">Graphic Design</h4>
                                </div>
                            </div>
                        </div>


                        <div class="service_slide">
                            <div class="row">
                                <div class="col-lg-5 text-right">
                                    <h4 class="text-uppercase">Photography</h4>
                                </div>
                                <div class="col-lg-2 middle_icon">
                                    <div class="service_icon">
                                        <img src="{{url('frontend_assets')}}/images/service_icon_1.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="service_text arrow_left">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typtting industry. Lorem Ipsum has been the industry's standard y text ever since the 1500s, when an unknown printer took a galleye and scrambled it to make a type specimen book. It has surve nothing
                                            is impossible centuries.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="service_slide">
                            <div class="row">
                                <div class="col-lg-5 text-right">
                                    <div class="service_text arrow_right">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typtting industry. Lorem Ipsum has been the industry's standard y text ever since the 1500s, when an unknown printer took a galleye and scrambled it to make a type specimen book. It has surve nothing
                                            is impossible centuries.
                                        </p>
                                    </div>

                                </div>
                                <div class="col-lg-2 middle_icon">
                                    <div class="service_icon">
                                        <img src="{{url('frontend_assets')}}/images/service_icon_2.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <h4 class="text-uppercase">Graphic Design</h4>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--Our Service Part End-->


    <!--Portfolio Part Start-->
    <section id="our_portfolio">
        <div class="portfolio">
            <div class="portfolio_overlay">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class=" header_section text-center ">
                                <h1 class="text-white ">Product Gallery</h1>
                                <p class="text-white ">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Loremsum has been the industry's standard dummy text ever since the 1500s.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="portfolio_content ">
                    <div class="container p-0 ">
                        <div class="row port_slider ">
                            <div class="col-lg-12 ">
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_1.jpg " alt=" " class="img-fluid p_img ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_1.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_2.jpg " alt=" " class="img-fluid ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_2.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_3.jpg " alt=" " class="img-fluid p_img ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_3.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_4.jpg " alt=" " class="img-fluid ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_4.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_5.jpg " alt=" " class="img-fluid p_img ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_5.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_6.jpg " alt=" " class="img-fluid ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_6.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_7.jpg " alt=" " class="img-fluid p_img ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_7.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_8.jpg " alt=" " class="img-fluid ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_8.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_5.jpg " alt=" " class="img-fluid p_img ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_5.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                                <div class="portfolio_image ">
                                    <img src="{{url('frontend_assets')}}/images/portfolio_6.jpg " alt=" " class="img-fluid ">
                                    <div class="portfolio_image_overlay ">
                                        <a class="port_veno " data-gall="gallery01 " href="{{url('frontend_assets')}}/images/portfolio_6.jpg "><i class="fas fa-search-plus "></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Portfolio Part End-->


    <!-- Priceing Package Area Start -->
    <div class="priceing ">
        <div class="container ">
            <div class="row ">
                <div class="col-lg-12 ">
                    <div class="pricing_heading text-center ">
                        <h1>Pick a plan that works for you</h1>
                        <p>We provide SSD Hosting with Top security and 99.99% up-time. Choose your suitable SSD hosting packages. We also provide Domain Name Registration Service.</p>
                    </div>
                </div>
            </div>
            <div class="row ">

                <div class="col-lg-4 col-md-4 ">
                    <div class="single-price-package priceing-bg ">
                        <div class="price-title ">
                            <h4>BASIC - 1</h4>
                            <h2>TK 6000 /Yearly</h2>
                        </div>
                        <div class="price-list ">
                            <ul>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                            </ul>
                        </div>
                        <div class="price-btn ">
                            <a href="javascript:void(0) " data-toggle="tooltip " data-original-title="Edit" class="edit button editProduct">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single-price-package priceing-bg">
                        <div class="price-title">
                            <h4>BASIC - 1</h4>
                            <h2>TK 6000 /Yearly</h2>
                        </div>
                        <div class="price-list">
                            <ul>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                            </ul>
                        </div>
                        <div class="price-btn">
                            <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit" class="edit button editProduct">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="single-price-package priceing-bg">
                        <div class="price-title">
                            <h4>BASIC - 1</h4>
                            <h2>TK 6000 /Yearly</h2>
                        </div>
                        <div class="price-list">
                            <ul>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit.</li>
                            </ul>
                        </div>
                        <div class="price-btn">
                            <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit" class="edit button editProduct">Buy Now</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Priceing Package Area End -->



    <!--details part start-->
    <section>
        <div class="details">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 ">
                        <div class="details_text">
                            <h1>Quality time for quality candidates.</h1>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="details_img">
                            <img src="{{url('frontend_assets')}}/images/about.png" alt=" " class="img-fluid wow fadeInRight" data-wow-duration="1.5s">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--details part end-->





    <!--Contact Part Start-->
    <section id="contact_us">
        <div class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="test_heading text-center">
                            <h1>|| <span>Contact</span> Us<span> .</span></h1>
                        </div>
                    </div>
                </div>
                <div class="contact_content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="contact_details wow fadeInUp" data-wow-duration="1.2s">
                                <span>01</span>
                                <i class="fas fa-mobile-alt"></i>
                                <h3>Call Me</h3>
                                <p>+88-019-69-005035</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="contact_details wow fadeInUp" data-wow-duration="1.2s">
                                <span>02</span>
                                <i class="fas fa-mail-bulk"></i>
                                <h3>Email Me</h3>
                                <p>waresul2006@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="contact_details wow fadeInUp" data-wow-duration="1.2s">
                                <span>03</span>
                                <i class="fas fa-home"></i>
                                <h3>Visit Me</h3>
                                <p>Dhanmondi, Dhaka</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact_form">
                    <form action="" method="">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="f_name" placeholder="Your Name" class="wow fadeInUp" data-wow-duration="1.2s" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="email" placeholder="Your Email" class="wow fadeInUp" data-wow-duration="1.2s" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" name="subject" placeholder="Subject" class="wow fadeInUp" data-wow-duration="1.2s" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <textarea placeholder="Type Your Message" class="wow fadeInUp" data-wow-duration="1.2s" required></textarea>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="wow fadeInUp" data-wow-duration="1.2s"><i class="fas fa-paper-plane"></i> Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Part End-->


@endsection
