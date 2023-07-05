@extends('task-layout.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Show All Task
            <i class="bi bi-check"></i>
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
                            @foreach ($trashedProject as $project)
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
                                        <form action="{{ route('project.restore', $project->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm me-2">Restore</button>
                                        </form>
                                        <form action="{{ route('project.destroy', $project->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $trashedProject->links() }}
                    </div>
            </div>
            </div>
        </div>
@endsection
