@extends('layouts.app')

@section('content')
    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Title*</label>
            <input type="text" class="form-control" name="title" value="{{ $project->title }}">
        </div>

        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Client*</label>
            <select class="form-select" name="client_id">
                <option value="">Choose a client</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $project->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->fullName }}
                    </option>
                @endforeach
            </select>
        </div>

        @error('client_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Description*</label>
            <textarea class="form-control" name="description" rows="10">{{ $project->description }}</textarea>
        </div>

        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Start date*</label>
            <input type="date" class="form-control" name="start_date" value="{{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}">
        </div>
        
        @error('start_date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Budget*</label>
            <input type="number" class="form-control" name="budget" value="{{ $project->budget }}" >
        </div>
        
        @error('budget')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" value="{{ $project->image }}" > 
        </div>
        
        <div class="mb-3">
            <label class="form-label">Project Status*</label>
            <select class="form-select" name="project_status">
                <option value="" selected>Choose a status</option>
                @foreach ($project_status as $status)
                    <option value="{{ $status }}" {{ $project->project_status == $status ? 'selected' : '' }}>
                        {{ $status }}</option>
                @endforeach
            </select>
        </div>

        @error('project_status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection