@extends('layouts.app')

@section('content')

    <div class="container col-8 offset-2">
        <form action="{{route('projects.update',$project->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')
            <div class="row form-group">
                <label for="title" class="col-form-label text-md-end">{{ __('title') }}</label>
                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                       name="title"  value="{{ $project->title }}" required >
            </div>
            <div class="row form-group">
                <label for="description" class="col-form-label text-md-end">{{ __('description') }}</label>
                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                          name="description" value="{{ $project->description }}" required>
                </textarea>
            </div>
            <div class="form-group">
                <label for="deadline">deadline</label>
                <input type="date" class="form-control"
                       name="deadline"  id="deadline" value="{{ $project->deadline }}" required />

            </div>

            <div class="form-group">
                <label for="user">assigned user</label>
                <select class="form-control" name="assigned_user" required>
                    @foreach($users as $user)
                          <option value="{{ $user->id }}" >{{ $user->name }} </option>

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





            <button type="submit"> update </button>
        </form>
    </div>
@endsection
