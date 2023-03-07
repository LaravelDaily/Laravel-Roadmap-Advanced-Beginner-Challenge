@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('projects.create') }}">
                <button type="button" class="btn btn-success mb-2">
                    <svg class="icon">
                        <use xlink:href="{{asset('svg/free.svg#cil-plus')}}"></use>
                    </svg> Add
                </button>
            </a>
            <div class="card">
                <div class="card-header">{{ __('Projects') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Status</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->deadline }}</td>
                                <td>{!! $project->status ? '<span class="badge text-bg-success">Open</span>':'<span class="badge text-bg-danger">Closed</span>' !!}</td>
                                <td>{{ $project->user->name }}</td>
                                <td> <a href="{{ route('projects.edit',$project->id) }}" class="btn btn-info mr-1"><svg class="icon">
                                            <use xlink:href="{{asset('svg/free.svg#cil-pencil')}}"></use>
                                        </svg> Edit </a>
                                    <form action="{{route('projects.destroy',$project->id)}}" method="POST" style="all:unset">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><svg class="icon">
                                                <use xlink:href="{{asset('svg/free.svg#cil-trash')}}"></use>
                                            </svg> Delete </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $projects->links('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection