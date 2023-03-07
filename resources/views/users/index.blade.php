@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('users.create') }}">
                <button type="button" class="btn btn-success mb-2">
                    <svg class="icon">
                        <use xlink:href="{{asset('svg/free.svg#cil-plus')}}"></use>
                    </svg> Add
                </button>
            </a>
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td> <a href="{{ route('users.edit',$user->id) }}" class="btn btn-info mr-1"><svg class="icon">
                                            <use xlink:href="{{asset('svg/free.svg#cil-pencil')}}"></use>
                                        </svg> Edit </a>
                                    <form action="{{route('users.destroy',$user->id)}}" method="POST" style="all:unset">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><svg class="icon">
                                                <use xlink:href="{{asset('svg/free.svg#cil-trash')}}"></use>
                                            </svg> Delete </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $users->links('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection