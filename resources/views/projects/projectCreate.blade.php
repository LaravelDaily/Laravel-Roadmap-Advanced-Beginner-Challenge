@extends('layouts.app')
@section('content')

    <div class="card uper" style="margin-left: 50px">
    <div class="card-header">
        Add project
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
              action="{{ route('projects.store') }}"
              enctype="multipart/form-data">

            <div class="form-group">
                @csrf
                <label for="title"> title</label>
                <input type="text" class="form-control"
                       name="title"/>
            </div>


            <div class="form-group">
                <label for="description">description</label>
                <input type="text" class="form-control"
                       name="description" id="description"/>
            </div>


            <div class="form-group">
                <label for="deadline">deadline</label>
                <input type="date" class="form-control"
                       name="deadline"  id="deadline" />

            </div>

            <div class="form-group">
                <label for="user">assigned user</label>
             <select class="form-control" name="assigned_user">
                 @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }} </option>
                 @endforeach
             </select>
            </div>

            <div class="form-group">
                <label for="client">assigned client</label>
                <select class="form-control" name="assigned_client">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="department"> department </label>
                <select class="form-control" name="department">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->title }} </option>
                    @endforeach
                </select>
            </div>



            <button type="submit"
                    class="btn btn-primary" style="margin-top: 10px">save</button>
        </form>
    </div>
</div>

@endsection
