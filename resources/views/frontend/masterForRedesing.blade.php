<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{url('frontend_assets')}}/images/favicon.ico">
    <title>TalenXo</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200;300;400;500;600;700;800&family=Open+Sans:wght@300;400;600;700;800&family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@200;300;400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/all.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/animate.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/slick.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/style2.css">

    @yield('header_css')
    @yield('header_js')
</head>

<body data-spy="scroll" data-target=".header" data-offset="150">

    <!--Preloader Start-->
    <div class="preloader">
        <div class="loader-classic">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!--Preloader End-->

    <!--header part start-->
    <section id="header">
        <div class="header">
            <div class=" container-fluid ">
                <nav class="navbar navbar-expand-lg bg-transparent ">
                    <a class="navbar-brand " href="{{url('/')}}">
                        <img src="{{url('frontend_assets')}}/images/logo.png" class="img-fluid" style="width: 200px">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false " aria-label="Toggle navigation ">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/product/tour')}}">Product Tour</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/pricing')}}">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/test/bank')}}">Test Bank</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/login')}}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link last_item" href="{{url('/register')}}">Try For Free</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </section>
    <!--header part end-->



    @yield('content')



    <!--footer js start-->
    <div class="footer_class">
        <div class="row last_footer">
           <div class="col-lg-3">
               <ul>
                   <li><a href="">About Us</a></li>
                   <li><a href="">Feedback</a></li>

               </ul>
           </div>
           <div class="col-lg-3">
               <ul>
                   <li><a href="">Community</a></li>
                   <li><a href="">Help & Support</a></li>

               </ul>
           </div>
           <div class="col-lg-3">
               <ul>
                   <li><a href="">Terms of Service</a></li>
                   <li><a href="">Privacy Policy</a></li>

               </ul>
           </div>
           <div class="col-lg-3">
               <ul>

                   <li><a href="">Contact Us</a></li>
                   <li><a href="">Enterprise Solutions</a></li>
               </ul>
           </div>
        </div>
        <hr>
        <span> Follow us
            <a href=""><i class="fa fa-facebook-f"></i> </a>
            <a href=""><i class="fa fa-linkedin"></i> </a>
            <a href=""><i class="fa fa-twitter"></i></a>
        </span>
        <span class="mobile">
            Mobile App
            <a href=""><i class="fa fa-apple"></i> </a>
            <a href=""><i class="fa fa-android"></i></a>
        </span>
        <hr>
        <p>© TalentAsse-2021</p>
    </div>
    <!--footer js end-->

    <!--Top Button Start-->
    <div class="top_btn wow bounceInRight">
        <i class="fas fa-arrow-up"></i>
    </div>
    <!--Top button End-->

    <script src="{{url('frontend_assets')}}/js/jquery-1.12.4.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/popper.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/bootstrap.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/slick.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/waypoints.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/wow.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/jquery.counterup.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/custom.js"></script>
    <script src="{{url('js')}}/c218529370.js"></script>

    @yield('footer_js')
</body>

</html>
