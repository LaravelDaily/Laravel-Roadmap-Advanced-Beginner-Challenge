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
                <td>assigned user</td>
                <td> assigned client</td>
                <td> status</td>

{{--                                <td colspan="3"></td>--}}
                <td>Action</td>
            </tr>
            </thead>
            <tbody>


                <tr>
                    <td>{{$project->id}}</td>
                    <td>{{$project->title  }}</td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->deadline}}</td>
                    <td>{{$project->user->name}} </td>
                    <td> {{ $project->client->name ?? ''}}</td>
                    <td> {{ $project->status }}</td>

                        <td>
                        <form action="{{ route('projects.destroy', $project->id)}}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        </td>



                    <td>
                        <a class="btn btn-success"  href="{{route('projects.edit',$project->id)}}">edit</a>
                    </td>

                </tr>

            </tbody>
        </table>
    </div>
{{--    tasks--}}
    <h4 style="color: rebeccapurple"> project tasks</h4>
    <div class="row">
        <div class="col-6">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>id </td>
                    <td>title</td>
                    <td>description</td>
                    <td>deadline</td>
                    <td>status</td>
                    <td> assigned user</td>

                    {{--                                <td colspan="3"></td>--}}
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>


                <tr>
                    @foreach($project->tasks as $task)
                        <td>{{$task->id}}</td>
                        <td>{{$task->title  }}</td>
                        <td>{{$task->description}}</td>
                        <td>{{$task->deadline}}</td>
                        <td>{{$task->status}} </td>
                        <td> {{ $task->user->name }}</td>

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
        <div class="col-6">
            <form action="/project/tasks/create/{{ $project->id }}"
                  method="post">
                @csrf
                <div class="form-group">
                    <label for="title">title</label>
                    <input type="text" class="form-control"
                           name="title" required/>
                </div>
                <div class="form-group">
                    <label for="description">description</label>
                    <input type="text" class="form-control"
                           name="description" required/>
                </div>
                <div class="form-group">
                    <label for="deadline">deadline</label>
                    <input type="date" class="form-control"
                           name="deadline" required/>
                </div>
                <div class="form-group">
                    <label for="user">assigned user</label>
                    <select class="form-control" name="assigned_user">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn" type="submit" style="background-color: rebeccapurple">add task</button>
            </form>
        </div>
    </div>










@endsection
