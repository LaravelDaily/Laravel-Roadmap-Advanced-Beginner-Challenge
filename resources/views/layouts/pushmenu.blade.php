<div class="col-auto col-sm-3 vh-100 text-white p-0" id="sidebar">
    {{-- collapse colapse-horizontal --}}
    <div class="container-fluid bg-medium-gray h-100 p-0">
        <div class="navbar bg-dark-gray ">
            <h4 class="">CRM</h4>
        </div>
        <div class=" ">
            <div>
                <div>
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                </div>
                <div>
                    @can('manage users')
                        <a href="{{ route('users.index') }}">Users</a>
                    @endcan
                </div>
                <div>
                    <a href="{{ route('clients.index') }}">Clients</a>
                </div>
                <div>
                    <a href="{{ route('projects.index') }}">Projects</a>
                </div>
                <div>
                    <a href="{{ route('tasks.index') }}">Tasks</a>
                </div>
            </div>

            <div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>
    </div>
</div>
