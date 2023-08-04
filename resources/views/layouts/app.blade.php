<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Namma Kadai</title>

    <link rel="icon" type="image/png" href="{{ asset('auth/images/icons/favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('auth/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/main.css') }}">

</head>

<body>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('auth/vendor/countdowntime/countdowntime.js') }}"></script>
    <script src="{{ asset('auth/js/main.js') }}"></script>

</body>

</html>
