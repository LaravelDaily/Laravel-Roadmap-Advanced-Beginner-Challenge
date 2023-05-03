@extends('layouts.app')

@section('content')
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Email verified at</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="@if($user->trashed()) table-secondary @endif">
                    <th scope="row ">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    @foreach ($user->roles as $role)
                        <td>{{ $role->name }}</td>
                    @endforeach
                    <td class="@if(!$user->trashed()) d-flex align-items-center mt-1 @endif ">
                        @if ($user->trashed())
                        @else
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="">
        {{ $users->links() }}
    </div>
@endsection
