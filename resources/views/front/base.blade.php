<!doctype html>
<html lang="{{ Localization::getCurrentLocaleRegional() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Guanxi Media')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <link rel="stylesheet" href="{{ mix('css/fapp.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Noto+Serif|Oswald:300,700" rel="stylesheet">
    <meta name="google-site-verification" content="RJF0Jhe0QhWiDFeHN9rhO1UpEMG0RUXGATG7nfS8xFM" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#803EA0">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YKM9CYN4J2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-YKM9CYN4J2');
    </script>

{{--    @production--}}
{{--        <script data-ad-client="ca-pub-9642330358282954" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
{{--    @endproduction--}}

</head>
<body class="pt-16 text-black font-sans antialiased @yield('bodyclass', 'scripted')">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="" id="app">
    @yield('content')
    @include('front.partials.footer')
    @include('front.partials.navbar')
</div>
<script src="{{ mix('js/front.js') }}"></script>
@yield('bodyscripts')
        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->


</body>
</html>
