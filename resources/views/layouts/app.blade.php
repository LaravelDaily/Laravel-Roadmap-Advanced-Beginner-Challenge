<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="container-fluid">
    @auth
        <div class="row flex-nowrap">
            @include('layouts.pushmenu')
            <div class="col-sm col px-0" id="app">
                <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
                    <div class="container">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">
                                <li>
                                    <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"><i
                                            class="bi bi-list fs-2"></i></a>
                                </li>
                            </ul>

                            <ul class="navbar-nav ms-auto align-items-center">
                                <!-- Authentication Links -->
                                <li class="nav-item px-3">
                                    <i class="bi bi-bell fs-4"></i>
                                </li>
                                <li class="nav-item dropdown ps-2 pe-4">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="bi bi-person fs-4"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            @endauth

            <main class="py-4 @guest d-flex align-items-center vh-100 @endguest ">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
