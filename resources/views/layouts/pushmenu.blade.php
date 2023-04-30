<div class="col-auto col-sm-3 vh-100  text-white p-0" id="sidebar">
    {{-- collapse colapse-horizontal --}}
    <div class="container-fluid bg-medium-gray h-100 p-0">
        <div class="navbar bg-dark-gray ">
            <h4 class="">CRM</h4>
        </div>
        <div class=" ">
            <div>
                <a href="{{ url('/dashboard') }}" >Dashboard</a>
            </div>
            <div>
                {{-- <a href="{{ route('') }}">Users</a> --}}
            </div>
            <div>
                <a href="{{ route('clients.index') }}">Clients</a>
            </div>
            <div>
                {{-- <a href="{{ route('projects.index') }}">Projects</a> --}}
            </div>
            <div>
                {{-- <a href="{{ route('tasks.index') }}">Tasks</a> --}}
            </div>
        </div>
    </div>
</div>