<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')

    <style>
        body {
            background: url({{$background}}) no-repeat fixed center center;
            background-size: cover;
        }

    </style>
</head>
<body>
    <div id="app">
        @include('layouts.includes.header')

        <main class="py-4">
            <div class="container p-1">
                @yield('content')
            </div>
        </main>
    </div>
    @include('layouts.includes.script')
</body>
</html>
