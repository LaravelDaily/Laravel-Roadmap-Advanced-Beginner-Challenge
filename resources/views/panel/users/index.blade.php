@extends('user-layout.app')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="/users/create" class="btn btn-primary">Create User
            <i class="bi bi-plus"></i>
        </a>
        <a href="{{ route('users.trash') }}" class="btn btn-primary p-2">
            Recycle Bin <i class="bi bi-trash"></i>
            @if ($usersTrashed->count() > 0)
                <span class="badge bg-danger ms-1 rounded-circle">{{ $usersTrashed->count() }}</span>
            @endif
        </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                @if (session('msg'))
                    <div class="alert alert-success text-center rounded-0">
                        <span>{{ session('msg') }}</span>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td class="d-flex align-item-center">
                                        <a href={{ route('users.edit', $user->id) }}
                                                    class="btn btn-success btn-sm me-2">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Suspend</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
