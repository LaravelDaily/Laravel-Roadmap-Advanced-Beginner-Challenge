@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-6 p-0">
                    <a href="{{ route('admin.tasks.create') }}" class="btn btn-success ">Create Project</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>project</th>
                        <th>name</th>
                        <th>description</th>
                        <th>completed</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{  $task->project->title ?? 'not mentionned' }}</td>
                            <td>{{ $task->name }}</td>
                            <td>{{ Str::limit($task->description, 30, '...') }}</td>
                            <td>{{ isset( $task->completed ) ? 'completed' : 'incomplete' }}</td>
                            <td>
                                <a href='{{ route('admin.tasks.edit', ['task' => $task->id]) }}' class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button  class="btn btn-danger btn-sm" type="button" onclick="if(confirm('Are you sure you want to delete this item?')) { this.form.submit() }">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
