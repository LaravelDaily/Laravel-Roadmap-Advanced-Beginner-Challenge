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

        <h2>Tasks</h2>

        @can('create tasks')
            <a class="block p-3 w-36 mb-5 rounded text-white text-center bg-green-600 hover:bg-green-800 cursor-pointer" href="{{route('tasks.create')}}">{{__('Create task')}}</a>
        @endcan

        <div class="block my-2">{{$tasks->links()}}</div>

        <table class="w-full">
            <thead>
            <tr class="w-full border-b-4 border-indigo-900">
                    <th>Title</th>
                    <th>Description</th>
                    <th>Deadline</th>
                    <th>User</th>
                    <th>Project</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @if(count($tasks) === 0)
                    <tr>
                        <td colspan="6" class="py-3">
                            No tasks found...
                        </td>
                    </tr>
                @else
                    @foreach($tasks as $task)
                        <tr class="hover:bg-gray-300 cursor-pointer" onclick="window.location='{{route('tasks.show', $task->id)}}'">
                            <td class="py-3 px-2">{{$task->title}}</td>
                            <td class="py-3 px-2">{{$task->description}}</td>
                            <td class="py-3 px-2">{{$task->deadline}}</td>
                            <td class="py-3 px-2">{{$task->user->name ? $task->user->name : 'User not found'}}</td>
                            <td class="py-3 px-2">{{$task->project->title ? $task->project->title : 'Project not found'}}</td>
                            <td class="py-3 px-2">{{$task->status->state}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
