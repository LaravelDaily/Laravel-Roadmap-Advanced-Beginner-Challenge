@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <label class="form-label">Name*</label>
            <input type="text" class="form-control" value="{{ $user->name }}" name="name">
        </div>

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Email*</label>
            <input type="text" class="form-control" value="{{ $user->email }}" name="email">
        </div>

        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Roles*</label>
            <select class="form-select" aria-label="Default select example" name="role">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn btn-danger">Submit</button>
    </form>
@endsection
