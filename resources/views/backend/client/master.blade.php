<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{url('frontend_assets')}}/images/favicon.ico">
    <title>TestTalents</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200;300;400;500;600;700;800&family=Fira+Sans+Condensed:wght@400;500;600;700;800&family=Open+Sans:wght@300;400;600;700;800&family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@200;300;400;500;600;700;800;900&family=Raleway:wght@200;300;400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/all.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/animate.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/slick.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/backend_style.css">

    @yield("header_css")
    @yield("header_js")

</head>

<body data-spy="scroll" data-target=".header" data-offset="150" class="bg-white">

    <!--header part start-->
    {{-- <section id="header">
        <div class="header">
            <div class=" container-fluid ">
                <nav class="navbar navbar-expand-lg bg-transparent ">
                    <a class="navbar-brand" href="#">
                        <img src="{{url('frontend_assets')}}/images/logo.png" class="img-fluid" style="width: 200px">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false " aria-label="Toggle navigation ">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">

                        </ul>
                    </div>

                </nav>
            </div>
        </div>
    </section> --}}
    <!--header part end-->

    @yield('content')


    <script src="{{url('frontend_assets')}}/js/popper.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/jquery-1.12.4.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/bootstrap.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/slick.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/waypoints.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/wow.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/jquery.counterup.min.js"></script>
    {{-- <script src="{{url('frontend_assets')}}/js/custom.js"></script> --}}
    {{--  Fontawesome  --}}
    <script src="{{url('js')}}/c218529370.js"></script>

    @yield('footer_js')

</body>

</html>
