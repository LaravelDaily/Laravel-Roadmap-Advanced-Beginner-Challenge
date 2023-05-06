@extends('layouts.app');
@section('content')


    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <td>id </td>
                <td>title</td>
                <td>description</td>
                <td>deadline</td>
                <td>status</td>
                <td>belong to project</td>
                <td>assigned user</td>


                {{--                <td colspan="3">Action</td>--}}
                <td>Action</td>
            </tr>
            </thead>
            <tbody>

            @foreach($tasks as $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$task->description  }}</td>
                    <td>{{$task->deadline}}</td>
                    <td>{{$task->status}}</td>
                    <td>{{$task->project->title}}</td>
                    <td>{{$task->user->name}}</td>


                    <td>
                        <form action="{{ route('tasks.destroy', $task->id)}}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>


                    <td>

                        <a class="btn btn-success"  href="{{route('tasks.edit',$task->id)}}">edit</a>

                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>





@endsection
