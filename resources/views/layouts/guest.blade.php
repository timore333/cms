<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <link href="{{asset('theme/dark/dist/css/pages/login-register-lock.css')}}" rel="stylesheet">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('theme/assets/images/favicon.png')}}">
    <title>Login</title>


    <!-- page css -->
    <link href="{{asset('theme/dark/dist/css/pages/login-register-lock.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('theme/dark/dist/css/style.min.css')}}" rel="stylesheet">
    <script src="{{asset('theme/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>

{{ $slot }}

<!-- ============================================================== -->
<script src="../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/node_modules/popper/popper.min.js"></script>
<script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!--Custom JavaScript -->
<script type="text/javascript">
    $(function () {
        $(".preloader").fadeOut();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

</script>
</body>
</html>
