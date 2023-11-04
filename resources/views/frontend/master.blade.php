<!DOCTYPE html>
<html lang="en">

<head>

    {{-- Google Analytics --}}
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-KWW0TSK91V"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-KWW0TSK91V');
    </script> --}}

    <meta charset="utf-8">

    <meta name="keywords" content="TestTalents, TestTalents">
    <meta name="description" content="Find the Best Candidate">
    <meta name="author" content="TestTalents">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{url('frontend_assets')}}/images/favicon.ico">
    <title>TestTalents</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200;300;400;500;600;700;800&family=Open+Sans:wght@300;400;600;700;800&family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@200;300;400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/all.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/animate.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/slick.css">

    @yield('header_css')
    @yield('header_js')

</head>

<body data-spy="scroll" data-target=".header" data-offset="150">

    <!--header part start-->
    <section id="header">
        <div class="header">
            <div class=" container-fluid ">
                <nav class="navbar navbar-expand-lg bg-transparent ">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{url('frontend_assets')}}/images/logo.png" class="img-fluid" alt="Logo" style="width: 65px; transform: scale(1.2)">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}">Home</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{url('/product/tour')}}">Product Tour</a>
                            </li> --}}

                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/test/bank')}}">Test Bank</a>
                            </li>

                            @auth
                                @if(Auth::user()->type == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url("view/all/questions")}}">Question Bank</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/pricing')}}">Pricing</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link last_item" href="{{url('/home')}}">Go to Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/pricing')}}">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/login')}}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link last_item" href="{{url('/register')}}">Try For Free</a>
                                </li>
                            @endauth

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
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <b class="d-inline-block mb-2">Dhaka Office:</b><br>
                    Testtalents Group,<br>
                    House # 8/B, Flat # A-1,
                    <br>Road # 103, Gulshan-2<br>
                    Dhaka-1212<br>
                    Bangladesh
                </div>
                <div class="col-lg-3">
                    <b class="d-inline-block mb-2">Singapore Office:</b><br>
                    Testtalents Group,<br>
                    Street: New Bridge Centre 336 Smith Street #06-305, <br>
                    City:  Singapore,<br>
                    Zip code:  050336,<br>
                    Country: Singapore<br>
                    Phone NO:  +65 62251753
                </div>
                <div class="col-lg-3">
                    <b class="d-inline-block mb-2">Registered Office:</b><br>
                    Testtalents Group,<br>
                    Phone No: 01911184275,<br>
                    Bogura,<br>
                    Bangladesh<br>
                    <b class="d-inline-block mb-1 mt-3">Trade License:</b><br>
                    24367
                </div>
                <div class="col-lg-3">
                    <ul class="last_footer">
                        <li><a href="{{url('about/us')}}"><i class="far fa-address-card"></i> About Us</a></li>
                        <li><a href="{{url('career')}}"><i class="fas fa-briefcase"></i> Career at TestTalents</a></li>
                        <li><a href="{{url('terms')}}"><i class="fas fa-list"></i> Terms of Use</a></li>
                        <li><a href="{{url('policy')}}"><i class="fas fa-user-lock"></i> Privacy Policy</a></li>
                        <li><a href="{{url('contact/us')}}"><i class="far fa-envelope"></i> Contact Us</a></li>
                    </ul>
                    <div class="row pt-2">
                        <div class="col-12">
                            <span> Follow:
                                <a href="https://www.facebook.com/TestTalents" target="_blank"><i class="fa fa-facebook-f"></i> </a>
                                <a href="https://www.linkedin.com/company/TestTalents-incorporation/?viewAsMember=true" target="_blank"><i class="fa fa-linkedin"></i> </a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <p>&copy; @php echo date("Y"); @endphp Copyright TestTalents</p>
        </div>
    </div>
    <!--footer js end-->


    <script src="{{url('frontend_assets')}}/js/jquery-2.2.4.min.js"></script>
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
