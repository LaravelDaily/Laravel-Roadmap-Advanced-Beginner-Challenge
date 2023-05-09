@extends('layouts.app')

@section('content')
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">First Name*</label>
            <input type="text" class="form-control" name="first_name">
        </div>

        @error('first_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Last Name*</label>
            <input type="text" class="form-control" name="last_name">
        </div>
        
        @error('last_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Company*</label>
            <input type="text" class="form-control" name="company">
        </div>

        @error('company')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Email*</label>
            <input type="text" class="form-control" name="email">
        </div>
        
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Phone*</label>
            <input type="text" class="form-control" name="phone">
        </div>
        
        @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Country*</label>
            <input type="text" class="form-control" name="country">
        </div>
        
        @error('country')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Project Status*</label>
            <select class="form-select" name="client_status">
                <option value="" selected>Choose a status</option>
                @foreach ($client_status as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>

        @error('client_status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection