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

        .navbar-brand {
            color: #fff;
            font-size: 24px;
        }

        .hero-section {
            background-image: url('https://source.unsplash.com/random/1600x600?crm');
            background-size: cover;
            background-position: center;
            height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            position: relative;
            background-color: rgba(0, 0, 0, 0.3);
        }

        .hero-section::before {
            position: absolute;
            color: #fff;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero-section h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .hero-section .btn-primary {
            font-size: 20px;
            padding: 12px 30px;
            cursor: pointer;
        }

        .features-section {
            padding: 80px 0;
        }

        .feature-box {
            text-align: center;
        }

        .feature-box i {
            font-size: 48px;
            color: #343a40;
            margin-bottom: 20px;
        }

        .feature-box h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .feature-box p {
            font-size: 16px;
            color: #6c757d;
        }

        .cta-section {
            background-color: #343a40;
            color: #fff;
            padding: 80px 0;
        }

        .cta-section h2 {
            font-size: 36px;
            margin-bottom: 40px;
        }

        .cta-section .btn-primary {
            font-size: 20px;
            padding: 12px 30px;
        }

        .footer {
            background-color: #f8f9fa;
            color: #343a40;
            padding: 40px 0;
            text-align: center;
        }

        .footer p {
            margin-bottom: 0;
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

    <section class="hero-section">
        <div class="container">
            <h1>
                {{ auth()->user() ? auth()->user()->name . ', Welcome' : 'Welome' }}
                to our CRM Platform</h1>
            <p>Manage your customers, track tasks, and grow your business with ease.</p>
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
            @endguest
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="bi bi-person-check-fill"></i>
                        <h3>Manage Customers</h3>
                        <p>Effortlessly organize and update customer information.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="bi bi-check"></i>
                        <h3>Track Tasks</h3>
                        <p>Monitor Tasks Performance and Assign Users Tasks.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="bi bi-clipboard-check"></i>
                        <h3>Create Projects</h3>
                        <p>Schedule appointments, meetings, and follow-ups with ease.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Ready to streamline your business operations?</h2>
            @guest
                <a href={{ route('login') }} class="btn btn-primary">Get Started</a>
            @endguest
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 CRM Project. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzvixwfQAXYcMCne3OsL8f1gnOGRRbh2aE9fT6Z5DSDwV0O2gkUx6llYy+1wM/K1" crossorigin="anonymous">
    </script>

</body>

</html>
