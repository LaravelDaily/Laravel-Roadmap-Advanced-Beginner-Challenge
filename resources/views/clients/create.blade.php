@extends('layouts.app')

@section('content')
    <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">First Name*</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
        </div>

        @error('first_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Last Name*</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
        </div>
        
        @error('last_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Company*</label>
            <input type="text" class="form-control" name="company" value="{{ old('company') }}">
        </div>

        @error('company')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Email*</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
        </div>
        
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Phone*</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
        </div>
        
        @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Country*</label>
            <input type="text" class="form-control" name="country" value="{{ old('country') }}">
        </div>
        
        @error('country')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" value="{{ old('image') }}">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Project Status*</label>
            <select class="form-select" name="client_status">
                <option value="">Choose a status</option>
                @foreach ($client_status as $status)
                    <option value="{{ $status }}" {{ old('$client_status') == $status ? 'selected' : ''  }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        @error('client_status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection