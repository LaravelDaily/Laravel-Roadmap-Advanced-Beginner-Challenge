<header class="c-header c-header-light px-3">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show">
        <i class="cil-hamburger-menu"></i>
    </button>
    <ul class="c-header-nav ml-auto">
        <li class="c-header-nav-item px-3">
            <i class="c-icon cil-user mr-2"></i>
            {{ auth()->user()->name }}
        </li>
        <li class="c-header-nav-item px-3">
            <a class="c-header-nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="c-icon cil-account-logout mr-2"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    </ul>
</header>
