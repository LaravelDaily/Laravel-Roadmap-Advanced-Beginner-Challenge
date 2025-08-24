@extends('layouts.app')

@section('css')
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Task') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.tasks.store') }}">
                        @csrf


                        <div class="form-group">
                            <label for="project_id" class="control-label">Assigned Task</label>
                            <select class="form-control @error('project_id') is-invalid @enderror" id="project_id" name="project_id">
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">{{ __('Title') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="completed">Completed:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="completed" value="1" {{ $task->completed == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="completed">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="completed" value="0" {{ $task->completed == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="completed">
                                    No
                                </label>
                            </div>
                        </div>




                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                            <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#deadline').datepicker({
                format: 'yyyy-mm-dd',
            });
        });
    </script>
@endsection
