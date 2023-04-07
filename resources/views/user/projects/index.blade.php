@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            @can('Super Admin')
            <div class="row">
                <div class="col-md-6 p-0">
                    <a href="{{ route('user.projects.create') }}" class="btn btn-success ">Create Project</a>
                </div>
            </div>
            @endcan

            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>title</th>
                    <th>description</th>
                    <th>deadline</th>
                    <th>user_id</th>
                    <th>client_id</th>
                    <th>status</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($projects as $project)

                    <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ Str::limit($project->description, 40, '...') }}</td>
                    <td>{{ $project->deadline }}</td>
                    <td>{{ $project->user_id }}</td>
                    <td>{{ $project->client_id }}</td>
                    <td>{{ $project->status }}</td>
                    @can('Super Admin')
                    <td>
                        <a href='{{ route('user.projects.edit', ['project' => $project->id]) }}' class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('user.projects.destroy', $project->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button  class="btn btn-danger btn-sm" type="submit">Delete</button>
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
