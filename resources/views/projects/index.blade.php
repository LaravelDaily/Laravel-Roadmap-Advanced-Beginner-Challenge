@extends('layouts.app')

@section('content')
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Start date</th>
                <th scope="col">Budget</th>
                <th scope="col">Project status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row ">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->budget }}</td>
                    <td>{{ $project->project_status }}</td>
                    <td class="d-flex align-items-center mt-1">
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary me-2">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="">
        {{ $projects->links() }}
    </div>
@endsection
