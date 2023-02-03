<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/simplebar/simplebar.css')}}">
    <link rel="stylesheet" href="{{asset('/css/simplebar.css')}}">
    <!-- Main styles for this application-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="{{asset('css/examples.css')}}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        @include('layouts.sidebar')
        <div class="wrapper d-flex flex-column min-vh-100 bg-light">
            <header class="header header-sticky mb-4">
                <div class="container-fluid">
                    <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                        <svg class="icon icon-lg">
                            <use xlink:href="{{asset('icons/free.svg#cil-menu')}}"></use>
                        </svg>
                    </button><a class="header-brand d-md-none" href="#">
                        <ul class="header-nav ms-3">
                            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-md"><img class="avatar-img" src="{{asset('/img/avatars/9.jpg')}}" alt="user@email.com"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end pt-0">
                                    <div class="dropdown-header bg-light py-2">
                                        <div class="fw-semibold">Account</div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="post">@csrf
                                        <button type="submit" class="dropdown-item">
                                            <svg class="icon me-2">
                                                <use xlink:href="{{asset('/icons/free.svg#cil-account-logout')}}"></use>
                                            </svg> Logout
                                        </button>
                                    </form>

                                </div>
                            </li>
                        </ul>
                </div>
            </header>
            @yield('content')
        </div>
    </div>
    <script src="{{asset('js/coreui.bundle.min.js')}}"></script>
    <script src="{{asset('js/simplebar.min.js')}}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{asset('js/chart.min.js')}}"></script>
    <script src="{{asset('js/coreui-chartjs.js')}}"></script>
    <script src="{{asset('js/coreui-utils.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>