<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        Soufyane
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{asset('icons/free.svg#cil-speedometer')}}"></use>
                </svg> Dashboard</a></li>
        <li class="nav-title">User Management</li>
        <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">
                <svg class="nav-icon">
                    <use xlink:href="{{asset('icons/free.svg#cil-user-plus')}}"></use>
                </svg> Users</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('clients.index')}}">
                <svg class="nav-icon">
                    <use xlink:href="{{asset('icons/free.svg#cil-people')}}"></use>
                </svg> Clients</a></li>
        <li class="nav-title">Pages</li>
        <li class="nav-item"><a class="nav-link" href="{{route('projects.index')}}">
                <svg class="nav-icon">
                    <use xlink:href="{{asset('icons/free.svg#cil-applications')}}"></use>
                </svg> Projects</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('tasks.index')}}">
                <svg class="nav-icon">
                    <use xlink:href="{{asset('icons/free.svg#cil-task')}}"></use>
                </svg> Tasks</a></li>

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>