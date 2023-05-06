@extends('layouts.app');
@section('content')

    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
      @endif
        <a href="/done" class="btn btn-secondary"> Done projects</a>
        <a href="/projects" class="btn" style="margin-left: 10px;background-color: mediumpurple"> Return to projects</a>

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



{{--                <td colspan="3">Action</td>--}}
                <td>Action</td>
            </tr>
            </thead>
            <tbody>

            @foreach($projects as $project)
                <tr>
                    <td>{{$project->id}}</td>
                    <td>{{$project->title  }}</td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->deadline}}</td>
                    <td>{{$project->user->name}} </td>
                    <td> {{ $project->client->name ?? '' }}</td>
                    <td> {{ $project->status }}</td>



                    <td>
                        <form action="/projects/{{ $project->id }}"
                              method="get">
                            @method('POST')
                            @csrf
                            <button class="btn btn-primary" type="submit">Details</button>
                        </form>
                    </td>
                    <td>
                        <form action="/projects/{{ $project->id }}/delete"
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
            @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <a href="/projects/create" class="btn btn-success"> create project </a>
    </div>




@endsection
