<html>
    <head>
        <title>Fit at Any Age | @yield('title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script> window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
        <!-- section styles -->
        @stack('styles')
        <!-- Bootstrap Core CSS -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <!-- <link rel="stylesheet" href="//oss.maxcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ mix("css/dist/public.css") }}" />
    </head>
    <body>
        <div id="app">
            @section('navbar')
                @include('oxygen::partials.navbar')
            @show
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
{{--        @if (empty($noHeaderFooter))--}}
{{--            @include('oxygen::partials.footer')--}}
{{--        @endif--}}
    </body>
    <script src="{{ asset('js/dist/app.js') }}"></script>
    <!-- section scripts -->
    @stack('scripts')
</html>

@push('styles')
<style>
    .client-name {
        height: 25px;
        color: #1B2031;
        font-size: 21px;
        letter-spacing: 0.25px;
        line-height: 25px;
    }
</style>
@endpush
