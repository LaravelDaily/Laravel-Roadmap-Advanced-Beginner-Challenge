@extends('layouts.crm')

@section('main')
    <div class="rounded w-10/12 mx-auto mt-5 bg-white p-5">
        @if(session('message'))
            <div class="block w-full m-2 p-3 rounded border border-green-900 bg-green-500 text-center text-white">
                {{session('message')}}
            </div>
        @endif

        @if(session('error'))
            <div class="block w-full m-2 p-3 rounded border border-red-900 bg-red-500 text-center text-white">
                {{session('error')}}
            </div>
        @endif

        <h2>{{$project->title}}</h2>

        <h3>{{__('Client')}}: {{$project->client->name}}</h3>

        <h4>{{__('Project\'s user')}}: {{$project->user->name}} | {{__('Deadline')}}: {{$project->deadline}} | {{__('Status')}}: {{$project->status->state}}</h4>

        <p>{{$project->description}}</p>

        <h4 class="mt-3">Tasks</h4>

        <div>
            @if(count($project->tasks) > 0)
                @foreach($project->tasks as $task)
                    <div class="border-b-2 border-indigo-600 cursor-pointer hover:bg-gray-400" onclick="window.location='{{route('tasks.show', $task->id)}}'">
                        <p>{{$task->title}}<br />{{__('Assigned user')}}: {{$task->user->name}} | {{__('Status')}}: {{$task->status->state}} | {{__('Deadline')}}: {{$task->deadline}}</p>

                        <p>
                            {{$task->description}}
                        </p>
                    </div>
                @endforeach
            @else
                No tasks to show...
            @endif
        </div>

        <div class="block mx-auto mt-3 flex flex-row justify-center">
            @can('update projects')
                <x-action-button :href="route('projects.edit', $project)" type="edit">
                    {{__('Edit')}}
                </x-action-button>
            @endcan

            @can('delete projects')
                <form action="{{route('projects.destroy', $project)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this project?')">
                    @csrf
                    @method('DELETE')

                    <input class="p-3 w-24 ml-3 bg-red-600 hover:bg-red-800" type="submit" value="{{__('Delete')}}" />
                </form>
            @endcan
        </div>
    </div>
@endsection
