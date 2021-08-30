@extends('layouts.crm')

@section('main')
    <div class="rounded w-10/12 mx-auto mt-5 bg-white p-5">
        <h2>Create new task</h2>

        <form action="{{route('tasks.store')}}" method="post">
            @csrf

            <div>
                <x-label for="title" :value="__('Title')" />
                <input id="title" type="text" name="title" value="{{old('title')}}" required />

                @error('title')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="deadline" :value="__('Deadline')" />
                <input id="deadline" type="date" name="deadline" value="{{old('deadline')}}" required />

                @error('deadline')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="user_id" :value="__('Assigned user')" />
                <select name="user_id" id="user_id" required>
                    <option value="">Select user</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}" {{$user->id == old('user_id') ? 'selected' : ''}}>{{$user->name}}</option>
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
                        <option value="{{$project->id}}" {{$project->id == old('project_id') ? 'selected' : ''}}>{{$project->title}}</option>
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
                        <option value="{{$state->id}}" {{$state->id == old('state_id') ? 'selected' : ''}}>{{$state->state}}</option>
                    @endforeach
                </select>

                @error('state_id')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="description" :value="__('Description')" />
                <textarea name="description" id="description">{{old('description')}}</textarea>
            </div>

            <div class="mt-2">
                <input class="w-full p-2 bg-green-600 hover:bg-green-800" type="submit" value="{{__('Create')}}" />
            </div>
        </form>

        <a class="block rounded w-auto mt-2 p-2 text-center text-white bg-red-600 hover:bg-red-800" href="{{route('tasks.index')}}">{{__('Cancel')}}</a>
    </div>
@endsection
