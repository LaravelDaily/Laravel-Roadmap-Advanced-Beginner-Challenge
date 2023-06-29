@extends('user-layout.app')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('users.index') }}" class="btn btn-primary">Show All Users
            <i class="bi bi-person"></i>
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
                <div class="card-body">
                    <h5 class="card-title">Update User</h5>
                    <hr>
                    <div class="card-body">
                        <div class="container-width">
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="name" class="form-control mb-3" placeholder="Your Name"
                                    value="{{ $user->name }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <input type="email" name="email" class="form-control mb-3" placeholder="Your Email"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <button class="btn btn-success col-12">Update User</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
