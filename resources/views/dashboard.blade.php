@extends('layouts.app')

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Recent responses') }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover">
                                <thead>
                                <tr>
                                    <th>Content</th>
                                    <th>User</th>
                                    <th>Task</th>
                                    <th>Created</th>
                                </tr>
                                </thead>
                                @foreach($responses as $response)
                                    <tr>
                                        <td>
                                            <a href="{{ route('task.show', $response->task->id) }}#response-{{ $response->id }}">
                                                {{ Str::limit($response->content) }}
                                            </a>
                                        </td>
                                        <td>{{ $response->user->name }}</td>
                                        <td>{{ $response->task->title }}</td>
                                        <td>{{ $response->created_at }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Tasks with new responses') }}</div>
                    <div class="card-body">
                        @include('task.partials.tasks-table')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Projects with new tasks') }}</div>
                    <div class="card-body">
                        @include('project.partials.projects-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
