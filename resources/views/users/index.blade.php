@extends('layouts.app')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col"></th>
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
                <tr>
                    <td></td>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    @foreach ($user->roles as $role)
                        <td>{{ $role->name }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="">
        {{ $users->links() }}
    </div>
@endsection
