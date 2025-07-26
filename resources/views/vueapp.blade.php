<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script> window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

        <title>Outlet for Fit At</title>
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" > -->
    </head>
    <body style="background-color: #d6dde9!important;">
        <div id="app">
            <app></app>
        </div>
        {{-- <script src="{{ asset('js/dist/app.js') }}"></script> --}}
        <script type="text/javascript" src="js/dist/vueapp.js"></script>
    </body>
</html>