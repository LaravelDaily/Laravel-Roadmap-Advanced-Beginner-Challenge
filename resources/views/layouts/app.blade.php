<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    .container-sm {
        max-width: 500px;
        margin: 0 auto;
    }

    .nav-underline {
        display: flex;
        justify-content: center;
        align-items: center;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-underline .nav-item {
        margin-right: 20px;
    }

    .nav-underline .nav-link {
        color: #000;
        text-decoration: none;
        position: relative;
        padding: 0;
        transition: color 0.3s;
    }

    .nav-underline .nav-link:before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #000;
        transform: scaleX(0);
        transition: transform 0.3s;
        transform-origin: bottom left;
    }

    .nav-underline .nav-link:hover,
    .nav-underline .nav-link:focus {
        color: #000;
    }

    .nav-underline .nav-link:hover:before,
    .nav-underline .nav-link:focus:before {
        transform: scaleX(1);
    }
</style>

<body>
    <div id="app">
        <main class="py-4 mt-5">
            @yield('content')
        </main>
    </div>
</body>

</html>
