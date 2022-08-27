@extends('app')
@section('title', __('Create Task'))
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Create New Task</span></h4>
        <div class="row">
            <div class="col-md-12">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="card mb-4">
                        <h4 class="px-3">Task Info</h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" type="text" id="title" name="title" autofocus
                                        value="{{ old('title') }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description"
                                        rows="5">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="html5-date-input" class="col-md-2 col-form-label">Deadline</label>
                                    <input class="form-control" name="deadline" type="date"
                                        value="{{ old('deadline') }}" id="html5-date-input">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="project" class="form-label">Assigned Project</label>
                                    <select class="form-select" id="project" name="project_id">
                                        <option selected disabled>Projects</option>
                                        @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option selected disabled>Status</option>
                                        <option value="open">open</option>
                                        <option value="pending">pending</option>
                                        <option value="ongoing">ongoing</option>
                                        <option value="completed">completed</option>
                                        <option value="canceled">canceled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>


<!-- Content wrapper -->
@endsection
