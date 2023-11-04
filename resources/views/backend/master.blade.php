<!DOCTYPE html>
<html>

<head>

    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-KWW0TSK91V"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-KWW0TSK91V');
    </script> --}}

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{url('frontend_assets')}}/images/favicon.ico">
    <title>TestTalents</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200;300;400;500;600;700;800&family=Open+Sans:wght@300;400;600;700;800&family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@200;300;400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/all.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/animate.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/slick.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/backend_style.css">
    <style>
        a.customList i{
            color: #1D4354
        }
        a.customList {
            color: #1D4354;
            font-weight: 600;
            transition: all .3s linear;
        }
    </style>
    @yield("header_css")
    @yield("header_js")

</head>

<body data-spy="scroll" data-target=".header" data-offset="150" style="min-height: 100vh">

    <!--header part start-->
    <section id="header">
        <div class="header">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg bg-transparent ">

                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{url('frontend_assets')}}/images/logo.png" class="img-fluid" style="width: 60px; transform: scale(1.2)">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false " aria-label="Toggle navigation ">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url("/home")}}">DashBoard</a>
                            </li>
                            {{--  <li class="nav-item">
                                <a class="nav-link" href="assesment.html">My Candidates</a>
                            </li>  --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{url("view/all/tests")}}">Test Bank</a>
                            </li>

                            @if(Auth::user()->type == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{url("view/all/questions")}}">Question Bank</a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link last_item" href="{{url('/plan/billing')}}">Upgarde Now</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{Auth::user()->name}} </a>
                                <div class="dropdown-menu" style="left: -25px;">
                                    <a class="dropdown-item border-bottom customList" href="{{url('/my/profile')}}"><i class="fas fa-user-circle"></i> My Profile</a>
                                    <a class="dropdown-item border-bottom customList" href="{{url('/plan/billing')}}"><i class="fas fa-coins"></i> Plan & Billing</a>
                                    @if(Auth::user()->type == 1)
                                    <a class="dropdown-item border-bottom customList" href="{{url('/view/custom/quotations')}}"><i class="fas fa-dollar-sign"></i> Custom Quotations</a>
                                    @endif
                                    {{-- <a class="dropdown-item border-bottom customList" href="#"><i class="fas fa-building"></i> Company Profile</a> --}}
                                    <a class="dropdown-item customList" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><b><i class="fas fa-sign-out-alt"></i> Logout</b></a>
                                </div>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </section>
    <!--header part end-->

    <!-- alert start -->
    <section>
        <div class="alert_section">

        </div>
    </section>
    <!-- alert end -->

    @yield('content')


    <!-- footer start-->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-2 text-white" style="background-color: #1D4354;">
            &copy; @php echo date("Y"); @endphp Copyright TestTalents
        </div>
    </footer>
    <!-- footer end-->



    <script src="{{url('frontend_assets')}}/js/popper.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/jquery-1.12.4.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/bootstrap.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/slick.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/waypoints.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/wow.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/jquery.counterup.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/custom.js"></script>
    {{--  Fontawesome  --}}
    <script src="{{url('js')}}/c218529370.js"></script>

    @yield('footer_js')

</body>

</html>
