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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #343a40;
        }

        .profile-container{
            max-width: 700px;
            margin: 0 auto;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Kiki CRM Plaform</a>
            <ul class="navbar-nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-light">Get Started</a>
                        </li>
                    @endif
                @endguest

                @auth
                    <a href="{{ route('profile') }}" class="btn btn-primary me-3 rounded-circle"><i class="bi bi-person-fill"></i></a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-danger" type="submit">Logout</button>
                    </form>
                @endauth
            </ul>
        </div>
    </nav>
    <div class="profile-container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h1 class="mb-5">User Credientials</h1>
                </div>
                <div class="card-content">
                    <div class="d-flex align-items-center">
                        <span class="display-6"><i class="bi bi-person-fill"></i></span>
                        <h2 class="lead">{{ auth()->user()->name }}</h2>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="display-6 me-2"><i class="bi bi-envelope"></i></span>
                        <h2 class="lead">{{ auth()->user()->email }}</h2>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg rounded-pill">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
