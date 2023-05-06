@extends('layouts.app')
@section('content')


    <div class="card uper" style="margin-left: 50px">
        <div class="card-header">
            update task information
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post"
                  action="{{ route('tasks.update', $task->id ) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">

                    <label for="title"> title</label>
                    <input type="text" class="form-control"
                           name="title" required value="{{ $task->title }}"/>
                </div>


                <div class="form-group">
                    <label for="description">description</label>
                    <input type="text" class="form-control"
                           name="description" id="description"  value=" {{ $task->description }}" required/>
                </div>



                <div class="form-group">
                    <label for="deadline">deadline</label>
                    <input type="date" class="form-control"
                           name="deadline"  id="deadline" value="{{ $task->deadline }}"/>

                </div>


                <div class="form-group">
                    <label for="status">status</label>
                    <select value="{{ $task->status }}" name="status"  class="form-control">
                        <option value="todo">todo</option>
                        <option value="cancled">cancled</option>
                        <option value="in progress">in progress</option>
                        <option value="on hold">on hold</option>
                        <option value="Done">Done</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="project">project</label>
                    <select name="project"  class="form-control">
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}"> {{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="assigned_user">assigned user</label>
                    <select name="assigned_user"  class="form-control">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"> {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>


                <button type="submit"
                        class="btn btn-primary" style="margin-top: 10px">save</button>
            </form>
        </div>
    </div>

@endsection
