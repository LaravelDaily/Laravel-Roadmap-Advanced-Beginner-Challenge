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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-logo {
            color: #fff;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul.nav {
            margin-top: 30px;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #2c3036;
        }

        .sidebar .nav-link.active {
            background-color: #2c3036;
        }

        .sidebar .logout-btn {
            margin-top: 15rem;
        }

        .content {
            margin-left: 0;
            padding: 20px;
            transition: margin 0.3s ease;
            width: 100%;
        }

        .header {
            background-color: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin-bottom: 0;
        }

        .container-width {
            max-width: 700px;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
            }

            .content {
                margin-left: 250px;
            }
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(0);
            }

            .content {
                margin-left: 0px;
            }
        }
    </style>
</head>

<body class="bg-light">
<div class="d-flex">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" data-bs-scroll="true">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title">Crm Panel</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-person"></i> Clients
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-clipboard-check"></i> Projects
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-list-task"></i> Tasks
                    </a>
                </li>
            </ul>
            <div class="p-2 mt-5">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn btn btn-primary col-12">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="sidebar bg-primary d-none d-lg-block">
        <h3 class="sidebar-logo">CRM Panel</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index')  }}">
                    <i class="bi bi-person"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('clients.index')  }}">
                    <i class="bi bi-person-lines-fill"></i> Clients
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('project.create')  }}">
                    <i class="bi bi-clipboard-check"></i> Project
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tasks.index') }}">
                    <i class="bi bi-list-task"></i> Tasks
                </a>
            </li>
        </ul>
        <div class="p-2">

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn btn btn-light col-12">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="content">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                    <span class="me-5 position-relative">
                        <a href="{{ route('notification.index') }}" class="text-decoration-none text-dark">
                            <i class="bi bi-bell"></i>
                        </a>
                       @if(count($unreadNotifications) !== 0)
                            <span class="badge badge-danger bg-danger position-absolute bottom-50 rounded-circle">{{ count($unreadNotifications) }}</span>
                        @else
                            <span class="badge badge-danger bg-danger position-absolute bottom-50 rounded-circle d-none">{{ count($unreadNotifications) }}</span>
                        @endif
                    </span>
                <button class="btn btn-primary rounded-circle shadow-sm">
                    <i class="bi bi-person-fill"></i>
                </button>
            </div>
        <div id="app">
            @yield('content')
        </div>
        <div class="footer mt-5 text-center">
            <p>Copyright &copy; <span class="text-primary">CRM</span> Panel Inc. </p>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/bootstrap-icons.min.js"></script>
<script>
    const sidebar = document.querySelector('.sidebar');
    const collapseIcon = document.querySelector('.collapse-icon');

    collapseIcon.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
    });
</script>

</body>

</html>
