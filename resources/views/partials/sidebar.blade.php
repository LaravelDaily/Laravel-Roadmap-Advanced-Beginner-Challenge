<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        {{ config('app.name', 'Laravel') }}
    </div>
    <ul class="c-sidebar-nav ps">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('dashboard') }}">
                <i class="c-sidebar-nav-icon cil-spreadsheet"></i>
                Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-user"></i>
                Users
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('user.index') }}">
                        <i class="c-sidebar-nav-icon cil-list-rich"></i>
                        User list
                    </a>
                </li>
                @can('create', \App\Models\User::class)
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('user.create') }}">
                            <i class="c-sidebar-nav-icon cil-user-plus"></i>
                            Add user
                        </a>
                    </li>
                @endcan
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('user.deleted') }}">
                        <i class="c-sidebar-nav-icon cil-user-x"></i>
                        Deleted users
                    </a>
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-address-book"></i>
                Clients
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('client.index') }}">
                        <i class="c-sidebar-nav-icon cil-list-rich"></i>
                        Client list
                    </a>
                </li>
                @can('create', \App\Models\Client::class)
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('client.create') }}">
                            <i class="c-sidebar-nav-icon cil-user-plus"></i>
                            Add client
                        </a>
                    </li>
                @endcan
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('client.deleted') }}">
                        <i class="c-sidebar-nav-icon cil-user-x"></i>
                        Deleted clients
                    </a>
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-briefcase"></i>
                Projects
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('project.index') }}">
                        <i class="c-sidebar-nav-icon cil-list-rich"></i>
                        Project list
                    </a>
                </li>
                @can('create', \App\Models\Project::class)
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('project.create') }}">
                            <i class="c-sidebar-nav-icon cil-plus"></i>
                            Add project
                        </a>
                    </li>
                @endcan
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('project.deleted') }}">
                        <i class="c-sidebar-nav-icon cil-minus"></i>
                        Deleted projects
                    </a>
                </li>
            </ul>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-task"></i>
                Tasks
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('task.index') }}">
                        <i class="c-sidebar-nav-icon cil-list-rich"></i>
                        Task list
                    </a>
                </li>
                @can('create', \App\Models\Task::class)
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('task.create') }}">
                            <i class="c-sidebar-nav-icon cil-plus"></i>
                            Add task
                        </a>
                    </li>
                @endcan
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('task.deleted') }}">
                        <i class="c-sidebar-nav-icon cil-minus"></i>
                        Deleted tasks
                    </a>
                </li>
            </ul>
        </li>

        <i class="cis-playlist-add-check"></i>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized">
    </button>
</div>
