<!DOCTYPE html>
<html>

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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{url('frontend_assets')}}/images/favicon.ico">
    <title>TestTalents</title>
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/all.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/animate.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/slick.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/login.css">
    <link rel="stylesheet" href="{{url('frontend_assets')}}/css/toastr.min.css">

    <style>
        .invalid-feedback{
            display: block
        }
    </style>
</head>

<body data-spy="scroll" data-target=".header" data-offset="150">

    @yield('content')

    <script src="{{url('frontend_assets')}}/js/jquery-1.12.4.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/popper.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/bootstrap.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/slick.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/waypoints.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/wow.min.js"></script>
    <script src="{{url('frontend_assets')}}/js/jquery.counterup.min.js"></script>
    {{--  <script src="{{url('frontend_assets')}}/js/custom.js"></script>  --}}
    <script src="https://kit.fontawesome.com/c218529370.js"></script>
    <script src="{{url('frontend_assets')}}/js/login.js"></script>
    <script src="{{url('frontend_assets')}}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    @yield("footer_js")
</body>

</html>
