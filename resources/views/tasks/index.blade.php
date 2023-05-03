@extends('layouts.app')

@section('content')
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Task status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row ">{{ $task->id }}</th>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
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
    <div >
        {{ $tasks->links() }}
    </div>
@endsection
