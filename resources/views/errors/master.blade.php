<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOPS!</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{url('error_assets')}}/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="{{url('error_assets')}}/css/style.css" />
</head>

<body>
    <div id="notfound">
        <div class="notfound-bg">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        @yield('content')


    </div>

</body>

</html>