<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle', 'Register or Login')</title>

    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />

    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//oss.maxcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <link rel="stylesheet" href="{{ mix("css/dist/auth.css") }}" />

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <!-- Bootstrap Core CSS -->

    <!-- Custom Fonts -->
    <!-- <link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//oss.maxcdn.com/fontawesome/4.5.0/css/font-awesome.min.css" /> -->

    <link rel="stylesheet" href="//oss.maxcdn.com/animatecss/3.5.0/animate.min.css" type="text/css">
    <link rel="stylesheet" href="/css/theme/creative.css" type="text/css">

    <link rel="stylesheet" href="{{ mix("css/dist/public.css") }}" />

    <style>
        html, body.master-auth {
            height: 100%;
        }
    </style>
    @yield('styles')

</head>
<body class="master-auth" style="background:#d6ddea;">
<!-- <nav class="navbar navbar-expand-md navbar-light fixed-top navbar-app">
    <div class="container"> -->
        <!-- <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
            <!-- Left Side Of Navbar -->
            <!-- <ul class="navbar-nav mr-auto">

            </ul> -->

            <!-- Right Side Of Navbar -->
            <!-- <ul class="navbar-nav ml-auto"> -->
                <!-- Authentication Links -->
                <!-- @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div> -->
    <!-- </div>
</nav> -->

<div class="container-fluid" style="background:#d6ddea;">
    <div class="row justify-content-center align-items-center" style="margin-top: 50px;">
        <a href="{{ route('logout') }}">
            <img src="{{ asset('images/logo@2x.png') }}" alt="" style="width:345px; height:111px;">
        </a>
    </div>
    <div class="row justify-content-center align-items-center">

        @yield('content')
    </div>
</div>

{{--@if (empty($noHeaderFooter))--}}
{{--    @include('oxygen::partials.footer')--}}
{{--@endif--}}

<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>

@yield('scripts')

</body>
</html>
