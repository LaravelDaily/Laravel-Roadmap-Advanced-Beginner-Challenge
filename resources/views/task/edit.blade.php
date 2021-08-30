@extends('layouts.crm')

@section('main')
    <div class="rounded w-10/12 mx-auto mt-5 bg-white p-5">
        <h2>Edit task</h2>

        <form action="{{route('tasks.update', $task)}}" method="post">
            @csrf
            @method('PUT')

            <div>
                <x-label for="title" :value="__('Title')" />
                <input id="title" type="text" name="title" value="{{$task->title}}" required />

                @error('title')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="deadline" :value="__('Deadline')" />
                <input id="deadline" type="date" name="deadline" value="{{$deadline}}" required />

                @error('deadline')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="user_id" :value="__('Assigned user')" />
                <select name="user_id" id="user_id" required>
                    <option value="">Select user</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}" {{$user->id == $task->user->id ? 'selected' : ''}}>{{$user->name}}</option>
                    @endforeach
                </select>

                @error('user_id')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="project_id" :value="__('Project')" />
                <select name="project_id" id="project_id" required>
                    <option value="">Select project</option>
                    @foreach($projects as $project)
                        <option value="{{$project->id}}" {{$project->id == $task->project->id ? 'selected' : ''}}>{{$project->title}}</option>
                    @endforeach
                </select>

                @error('project_id')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="state_id" :value="__('Status')" />
                <select name="state_id" id="state_id">
                    <option value="">Select status</option>
                    @foreach($states as $state)
                        <option value="{{$state->id}}" {{$state->id == $task->status->id ? 'selected' : ''}}>{{$state->state}}</option>
                    @endforeach
                </select>

                @error('state_id')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="description" :value="__('Description')" />
                <textarea name="description" id="description">{{$task->description}}</textarea>
            </div>

            <div class="mt-2">
                <input class="w-full p-2 bg-green-600 hover:bg-green-800" type="submit" value="{{__('Update')}}" />
            </div>
        </form>

        <a class="block rounded w-auto mt-2 p-2 text-center text-white bg-red-600 hover:bg-red-800" href="{{route('tasks.show', $task)}}">{{__('Cancel')}}</a>
    </div>
@endsection
