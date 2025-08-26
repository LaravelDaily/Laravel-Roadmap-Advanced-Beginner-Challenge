@extends('layouts.app')

@section('content')
    <form action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">First Name*</label>
            <input type="text" class="form-control" name="first_name" value="{{ $client->first_name }}">
        </div>

        @error('first_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Last Name*</label>
            <input type="text" class="form-control" name="last_name" value="{{ $client->last_name }}">
        </div>
        
        @error('last_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Company*</label>
            <input type="text" class="form-control" name="company" value="{{ $client->company }}">
        </div>

        @error('company')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Email*</label>
            <input type="text" class="form-control" name="email" value="{{ $client->email }}">
        </div>
        
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Phone*</label>
            <input type="text" class="form-control" name="phone" value="{{ $client->phone }}">
        </div>
        
        @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Country*</label>
            <input type="text" class="form-control" name="country" value="{{ $client->country }}">
        </div>
        
        @error('country')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" value="{{ $client->image }}">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Project Status*</label>
            <select class="form-select" name="client_status">
                <option value="">Choose a status</option>
                @foreach ($client_status as $status)
                    <option value="{{ $status }}" {{ $client->client_status == $status ? 'selected' : ''  }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        @error('client_status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection