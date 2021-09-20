@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(session('responseCreated'))
                    <div class="alert alert-success" role="alert">
                        Response published!
                    </div>
                @endif
                @if(session('responseDeleted'))
                    <div class="alert alert-success" role="alert">
                        Response deleted!
                    </div>
                @endif
                @if ($errors->has('task_id'))
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->get('task_id') as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{ __('Task details') }}</div>
                    <div class="card-body">
                        <dl>
                            <dt>Title</dt>
                            <dd>{{ $task->title }}</dd>
                            <dt>Description</dt>
                            <dd>{{ $task->description }}</dd>
                            <dt>Project</dt>
                            <dd>{{ $task->project->title ?? '' }}</dd>
                            <dt>Client</dt>
                            <dd>{{ $task->project->client->company ?? '' }}</dd>
                            <dt>Assigned user</dt>
                            <dd>{{ $task->project->user->name ?? '' }}</dd>
                            <dt>Status</dt>
                            <dd>{{ $task->status }}</dd>
                        </dl>
                    </div>
                </div>
                @include('task.partials.task-media')
                @foreach($task->responses as $response)
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center">
                            {{ __('Response by: ') . $response->user->name }} |
                            {{ __('at: ') . $response->created_at }}

                            <a class="btn btn-link btn-sm ml-auto text-muted" id="response-{{ $response->id }}"
                               href="#response-{{ $response->id }}">#{{ $response->id }}</a>
                            @can('delete', $response)
                                |
                                <form action="{{ route('response.destroy', $response->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link btn-sm" type="submit"
                                            onclick="return confirm('Are you sure you want to delete?');">
                                        <i class="cil-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                        <div class="card-body">
                            {{ $response->content }}

                            @if($response->getMedia()->count())
                                <div class="row mt-3">
                                    @foreach($response->getMedia() as $media)
                                        <div class="col-6 col-md-4 col-lg-3 pb-4">
                                            <img class="img-fluid" src="{{ $media->getUrl() }}">
                                            @if(request()->routeIs('task.edit'))
                                                @can('manageMedia', $task)
                                                    <button
                                                        class="btn btn-link d-block mx-auto media-remove"
                                                        data-id="{{ $media->id }}"
                                                        type="button">
                                                        Remove file
                                                    </button>
                                                @endcan
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                @can('addResponse', $task)
                    <hr>
                    <div class="card">
                        <div class="card-header">Add response</div>
                        <div class="card-body">
                            <form id="response-form" action="{{ route('task.add-response') }}" method="POST">
                                @csrf
                                <input type="hidden" name="task_id" value="{{ encrypt($task->id) }}">
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                              required>{{ old('content') }}</textarea>
                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Media upload</label>
                                    <div class="dropzone"></div>
                                </div>
                                <button class="btn btn-primary" type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection

@include('partials.form-media-upload-script', ['formId' => '#response-form'])
