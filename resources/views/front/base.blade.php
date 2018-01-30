<!doctype html>
<html lang="{{ Localization::getCurrentLocaleRegional() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Guanxi Media')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <link rel="stylesheet" href="{{ elixir('css/fapp.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
    <script>
        var Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Noto+Serif|Oswald:300,700" rel="stylesheet">
    <meta name="google-site-verification" content="RJF0Jhe0QhWiDFeHN9rhO1UpEMG0RUXGATG7nfS8xFM" />
</head>
<body class="@yield('bodyclass', 'scripted')">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="main-container" id="app">
    @include('front.partials.navbar')
    @yield('content')
    @include('front.partials.footer')
</div>
<script src="{{ elixir('js/front.js') }}"></script>
@yield('bodyscripts')
        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
    ga('create','UA-51468211-11','auto');ga('send','pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
</html>
