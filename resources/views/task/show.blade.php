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

        <h2>{{$task->title}}</h2>

        <h3>{{__('Project')}}: {{$task->project->title}}</h3>

        <h4>{{__('Task\'s user')}}: {{$task->user->name}} | {{__('Deadline')}}: {{$task->deadline}} | {{__('Status')}}: {{$task->status->state}}</h4>

        <p>{{$task->description}}</p>

        <div class="block mx-auto mt-3 flex flex-row justify-center">
            @can('update tasks')
                <x-action-button :href="route('tasks.edit', $task)" type="edit">
                    {{__('Edit')}}
                </x-action-button>
            @endcan

            @can('delete tasks')
                <form action="{{route('tasks.destroy', $task)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this task?')">
                    @csrf
                    @method('DELETE')

                    <input class="p-3 w-24 ml-3 bg-red-600 hover:bg-red-800" type="submit" value="{{__('Delete')}}" />
                </form>
            @endcan
        </div>
    </div>
@endsection
