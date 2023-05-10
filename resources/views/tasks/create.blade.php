@extends('layouts.app')

@section('content')
    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title*</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        </div>

        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Description*</label>
            <textarea class="form-control" name="description" rows="10">{{ old('description') }}</textarea>
        </div>

        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Start date*</label>
            <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
        </div>

        @error('start_date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Task Status*</label>
            <select class="form-select" name="task_status">
                <option value="">Choose a status</option>
                @foreach ($task_status as $status)
                    <option value="{{ $status }}" {{ old('task_status') == $status ? 'selected' : '' }}>
                        {{ $status }}</option>
                @endforeach
            </select>
        </div>

        @error('task_status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
        </div>

        <div class="mb-3">
            <label class="form-label">Project*</label>
            <select class="form-select" name="project_id">
                <option value="">Choose a project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                        {{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        @error('project_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
