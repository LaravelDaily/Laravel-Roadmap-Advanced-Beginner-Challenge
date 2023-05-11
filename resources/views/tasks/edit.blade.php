@extends('layouts.app')

@section('content')
    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Title*</label>
            <input type="text" class="form-control" name="title" value="{{ $task->title }}">
        </div>

        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Description*</label>
            <textarea class="form-control" name="description" rows="10">{{ $task->description }}</textarea>
        </div>

        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Start date*</label>
            <input type="date" class="form-control" name="start_date" value="{{ $task->start_date }}">
        </div>

        @error('start_date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Task Status*</label>
            <select class="form-select" name="task_status">
                <option value="">Choose a status</option>
                @foreach ($task_status as $status)
                    <option value="{{ $status }}" {{ $task->task_status == $status ? 'selected' : '' }}>
                        {{ $status }}</option>
                @endforeach
            </select>
        </div>

        @error('task_status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" value="{{ $task->image }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Project*</label>
            <select class="form-select" name="project_id">
                <option value="">Choose a project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                        {{ $project->title }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection