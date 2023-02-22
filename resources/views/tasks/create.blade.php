@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('create Task') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="row g-3 needs-validation" action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="due_date" class="form-label">Due date</label>
                            <input type="datetime-local" class="form-control @error('due_date') is-invalid @enderror" name="due_date">
                            @error('due_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="user_id" class="form-label">Assigned User</label>
                            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col">
                                    <label for="taskable_type"> Taskable type </label>
                                    <select name="taskable_type" class="form-control" id="taskable_type">
                                        <option value="">Select a Type</option>
                                        <option value="project">Project</option>
                                        <option value="client">Client</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="taskable_id"> Taskable id </label>
                                    <select name="taskable_id" class="form-control" id="taskable_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                <option value="open">Open</option>
                                <option value="pending">Pending</option>
                                <option value="closed">Closed</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="priority" class="form-label">Priority</label>
                            <select name="priority" class="form-control @error('priority') is-invalid @enderror" id="priority">
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                            @error('priority')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('after_scripts')
<script>
    var taskableTypeSelect = document.getElementById('taskable_type');
    var taskableIdSelect = document.getElementById('taskable_id');

    taskableTypeSelect.addEventListener('change', function() {
        var taskableType = this.value;
        taskableIdSelect.innerHTML = "";
        if (taskableType !== "") {
            var taskableIds = taskableType == "project" ? JSON.parse('{!! json_encode($projects) !!}') : JSON.parse('{!! json_encode($clients) !!}');
            taskableIds.forEach(function(taskableId) {
                var option = document.createElement('option');
                option.value = taskableId.id;
                option.text = taskableType == "project" ? taskableId.title : taskableId.company;
                taskableIdSelect.add(option);
            });
        }
    });
</script>
@endsection