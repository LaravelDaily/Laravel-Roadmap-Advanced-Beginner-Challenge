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
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 flex flex-row">
    <aside id="left-menu" class="w-1/4 bg-blue-900 text-white">
        <x-left-menu />
    </aside>
    <div class="w-3/4">
        <div class="navigation">
            @include('layouts.navigation')
        </div>
        <main>
            @yield('main')
        </main>
    </div>
</div>
</body>
</html>
