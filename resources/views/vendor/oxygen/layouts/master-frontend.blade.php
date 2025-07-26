<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Sign up for your free trial now!')">

    <title>@yield('pageTitle', 'Fit Test')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css"/>

    <!-- Custom Fonts -->
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//oss.maxcdn.com/fontawesome/4.5.0/css/font-awesome.min.css"/>

    <link rel="stylesheet" href="//oss.maxcdn.com/animatecss/3.5.0/animate.min.css" type="text/css">
    <!-- <link rel="stylesheet" href="/css/theme/creative.css" type="text/css"> -->

    <link rel="stylesheet" href="{{ mix("css/dist/public.css") }}"/>

    <!-- <style>
        html, body.master-auth {
            height: 100%;
        }
    </style> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .sign-in {
            height: 18px;
            /* width: 53px;	 */
            color: #000;
            /* font-family: Montserrat;	 */
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 0.29px;
            line-height: 18px;
            text-align: right;
        }

        /* .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
            background-color: red;
            color: red;
        } */

        ul.nav a:hover {
            background-color: none !important;
        }
    </style>

    @stack('meta')

    @include('oxygen::partials.tracking')

    @yield('styles')
</head>

<body id="page-top" class="front-end" style="background:#d6ddea;">
@include('oxygen::partials.navbar')

@yield('contents')

{{--@if (empty($noHeaderFooter))--}}
{{--    @include('oxygen::partials.footer')--}}
{{--@endif--}}

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

{{-- All files below are to support the frontend theme. --}}
{{-- If you're changing the frontend, remove all files below. --}}

<script src="{{ asset('js/theme/jquery.easing.min.js')}}"></script>
<script src="{{ asset('js/theme/jquery.fittext.js')}}"></script>
<script src="{{ asset('js/theme/wow.min.js')}}"></script>
<script src="{{ asset('js/theme/creative.js')}}"></script>

@yield('scripts')
</body>
</html>
