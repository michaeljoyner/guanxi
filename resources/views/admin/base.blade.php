<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @section('title')
        <title>Guanxi | Admin</title>
    @show
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    @yield('head')
    <script>
        var Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>
</head>
<body class="font-display antialiased text-primary-dark">
<div id="app">
    @if(Auth::check())
        @include('admin.partials.navbar')
    @endif
    <div class="max-w-5xl px-6 mx-auto">
        @yield('content')
    </div>
</div>

<div class="main-footer"></div>
<script src="{{ mix('js/app.js') }}"></script>
@include('admin.partials.flash')
@yield('bodyscripts')
</body>
</html>