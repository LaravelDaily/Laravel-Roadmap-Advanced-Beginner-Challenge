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

        <h2>Projects</h2>

        @can('create projects')
            <a class="block p-3 w-36 mb-5 rounded text-white text-center bg-green-600 hover:bg-green-800 cursor-pointer" href="{{route('projects.create')}}">{{__('Create project')}}</a>
        @endcan

        <div class="mb-5 flex flex-row flex-wrap">
            <a class="block p-3 w-36 mb-2 mr-2 rounded text-white text-center bg-gray-400 hover:bg-gray-500 cursor-pointer" href="{{route('projects.index', ['status' => 'all'])}}">{{__('Show all')}}</a>

            <a class="block p-3 w-36 mb-2 mr-2 rounded text-white text-center bg-gray-400 hover:bg-gray-500 cursor-pointer" href="{{route('projects.index', ['status' => 1])}}">{{__('Show pending')}}</a>

            <a class="block p-3 w-36 mb-2 mr-2 rounded text-white text-center bg-gray-400 hover:bg-gray-500 cursor-pointer" href="{{route('projects.index', ['status' => 2])}}">{{__('Show in process')}}</a>

            <a class="block p-3 w-40 mb-2 mr-2 rounded text-white text-center bg-gray-400 hover:bg-gray-500 cursor-pointer" href="{{route('projects.index', ['status' => 3])}}">{{__('Show in to review')}}</a>

            <a class="block p-3 w-36 mb-2 mr-2 rounded text-white text-center bg-gray-400 hover:bg-gray-500 cursor-pointer" href="{{route('projects.index', ['status' => 4])}}">{{__('Show closed')}}</a>
        </div>

        <table class="w-full">
            <thead>
            <tr class="w-full border-b-4 border-indigo-900">
                    <th>Title</th>
                    <th>Deadline</th>
                    <th>Assigned user</th>
                    <th>Client</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @if(count($projects) === 0)
                    <tr>
                        <td colspan="5" class="py-3">
                            No projects found...
                        </td>
                    </tr>
                @else
                    @foreach($projects as $project)
                        <tr class="hover:bg-gray-300 cursor-pointer" onclick="window.location='{{route('projects.show', $project->id)}}'">
                            <td class="py-3 px-2">{{$project->title}}</td>
                            <td class="py-3 px-2">{{$project->deadline}}</td>
                            <td class="py-3 px-2">{{$project->user->name ? $project->user->name : 'User not found'}}</td>
                            <td class="py-3 px-2">{{$project->client->name ? $project->client->name : 'Client not found'}}</td>
                            <td class="py-3 px-2">{{$project->status->state}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
