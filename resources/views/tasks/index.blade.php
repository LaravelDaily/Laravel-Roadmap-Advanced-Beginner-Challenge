@extends('layouts.app')

@section('content')
    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">Create task</a>
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Project</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Task status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row ">{{ $task->id }}</th>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->project->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <img src="{{ $task->image ? $task->image : $task->getFirstMediaUrl('images') }}" alt=""
                            class="rounded" width="200" height="150">
                    </td>
                    <td>{{ $task->task_status }}</td>
                    <td class="d-flex align-items-center mt-1">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary me-2">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $tasks->links() }}
    </div>
@endsection
