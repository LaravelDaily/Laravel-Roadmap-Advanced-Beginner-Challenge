@extends('user-layout.app')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('users.index') }}" class="btn btn-primary">Show All Users
            <i class="bi bi-person"></i>
        </a>
        <a href="{{ route('users.trash') }}" class="btn btn-primary">
            Recycle Bin
            @if ($usersTrashed->count() > 0)
                <span class="badge bg-danger ms-2">{{ $usersTrashed->count() }}</span>
            @endif
        </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Create User</h5>
                    <hr>
                    <div class="card-body">
                        <div class="container-width">
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <input type="text" name="name" class="form-control mb-3" placeholder="Your Name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <input type="email" name="email" class="form-control mb-3" placeholder="Your Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <input type="password" name="password" class="form-control mb-3" placeholder="Your Password"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="password" name="password_confirmation" class="form-control mb-3"
                                    placeholder="Confirm Password" value={{ old('password_confirmation') }}>

                                <button class="btn btn-success col-12">Create User</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
