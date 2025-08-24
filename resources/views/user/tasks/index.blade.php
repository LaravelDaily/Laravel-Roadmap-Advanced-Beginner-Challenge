@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @can('Super Admin')
            <div class="row">
                <div class="col-md-6 p-0">
                    <a href="{{ route('user.tasks.create') }}" class="btn btn-success ">Create Project</a>
                </div>
            </div>
            @endcan
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>project</th>
                        <th>name</th>
                        <th>description</th>
                        <th>completed</th>
                        @can('Super Admin')
                        <th>actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{  $task->project->title ?? 'not mentionned' }}</td>
                            <td>{{ $task->name }}</td>
                            <td>{{ Str::limit($task->description, 30, '...') }}</td>
                            <td>{{ isset( $task->completed ) ? 'completed' : 'incomplete' }}</td>
                            @can('Super Admin')
                            <td>
                                <a href='{{ route('user.tasks.edit', ['task' => $task->id]) }}' class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('user.tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button  class="btn btn-danger btn-sm" type="button" onclick="if(confirm('Are you sure you want to delete this item?')) { this.form.submit() }">Delete</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
