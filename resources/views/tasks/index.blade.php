@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="{{ route('tasks.create') }}">
                <button type="button" class="btn btn-success mb-2">
                    <svg class="icon">
                        <use xlink:href="{{asset('svg/free.svg#cil-plus')}}"></use>
                    </svg> Add
                </button>
            </a>
            <div class="card">
                <div class="card-header">{{ __('tasks') }}</div>

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
                                <th scope="col">taskable</th>
                                <th scope="col">Due date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Priority</th>
                                <th scope="col">User</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->taskable_type }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{!! $task->status == "open" ? '<span class="badge text-bg-success">Open</span>':'<span class="badge text-bg-danger">'.$task->status.'</span>' !!}</td>
                                <td><span class="badge rounded-pill text-bg-info">{{ $task->priority}}</span></td>
                                <td>{{ $task->user->name }}</td>
                                <td> <a href="{{ route('tasks.edit',$task->id) }}" class="btn btn-info mr-1"><svg class="icon">
                                            <use xlink:href="{{asset('svg/free.svg#cil-pencil')}}"></use>
                                        </svg> Edit </a>
                                    <form action="{{route('tasks.destroy',$task->id)}}" method="POST" style="all:unset">
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
                    {!! $tasks->links('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection