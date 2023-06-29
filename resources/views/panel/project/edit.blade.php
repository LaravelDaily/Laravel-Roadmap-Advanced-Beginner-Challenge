@extends('task-layout.app')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Show All Tasks
            <i class="bi bi-person"></i>
        </a>
        <a href="{{ route('project.trash') }}" class="btn btn-primary p-2">
            Recycle Bin <i class="bi bi-trash"></i>
            @if ($projectTrashed->count() > 0)
                <span class="badge bg-danger ms-1 rounded-circle">{{ $projectTrashed->count() }}</span>
            @endif
        </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Update Project</h5>
                    <hr>
                    <div class="card-body">
                        <div class="container-width">
                            <form action="{{ route('project.update', $project->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="title" class="form-control mb-3" placeholder="Your Name"
                                       value="{{ $project->title }}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <input type="email" name="description" class="form-control mb-3" placeholder="Your Email"
                                       value="{{ $project->description }}">
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <button class="btn btn-success col-12">Update Project</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
