@extends('task-layout.app')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('project.create') }}" class="btn btn-primary">Create Project
            <i class="bi bi-plus"></i>
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
                @if (session('msg'))
                    <div class="alert alert-success text-center rounded-0">
                        <span>{{ session('msg') }}</span>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">Tasks</h5>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>DeadLine</th>
                            <th>User</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>Task Started</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->deadline }}</td>
                                <td>{{ $project->user->name }}</td>
                               @if(!$project->client)
                                    <td>Company Not Listed</td>
                                @else
                                    <td>{{ $project->client->company  }}</td>
                               @endif
                                <td>{{ $project->status }}</td>
                                <td>{{ $project->created_at }}</td>
                                <td class="d-flex align-item-center">
                                    <a href={{ route('project.edit', $project->id) }}
                                                    class="btn btn-success btn-sm me-2">Edit</a>
                                    <form action="{{ route('project.destroy', $project->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Trash</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
