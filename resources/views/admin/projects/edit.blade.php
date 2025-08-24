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
                <div class="card-header">{{ __('Edit Project') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $project->title ) }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"  required autocomplete="description">{{ old('description', $project->description) }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="deadline">Deadline:</label>
                                <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline"  value="{{ old('deadline', $project->deadline) }}">
                            </div>
                            @error('deadline')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_id" class="control-label">Assigned User</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{ old('user_id', $project->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="client_id" class="control-label">Assigned Project</label>
                            <select class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id">
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}" {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">

                                @foreach($status as $stat)
                                    <option value="{{$stat}}" {{ old('status', $project->status) == $stat ? 'selected' : '' }}>
                                        {{ $stat }}
                                    </option>
                                @endforeach

                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
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
