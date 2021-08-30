@extends('layouts.crm')

@section('main')
    <div class="rounded w-10/12 mx-auto mt-5 bg-white p-5">
        <h2>Edit project</h2>

        <form action="{{route('projects.update', $project)}}" method="post">
            @csrf
            @method('PUT')

            <div>
                <x-label for="title" :value="__('Title')" />
                <input id="title" type="text" name="title" value="{{$project->title}}" required />

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
                        <option value="{{$user->id}}" {{$user->id == $project->user->id ? 'selected' : ''}}>{{$user->name}}</option>
                    @endforeach
                </select>

                @error('user_id')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="client_id" :value="__('Client')" />
                <select name="client_id" id="client_id" required>
                    <option value="">Select client</option>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}" {{$client->id == $project->client->id ? 'selected' : ''}}>{{$client->name}}</option>
                    @endforeach
                </select>

                @error('client_id')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="state_id" :value="__('Status')" />
                <select name="state_id" id="state_id">
                    <option value="">Select status</option>
                    @foreach($states as $state)
                        <option value="{{$state->id}}" {{$state->id == $project->status->id ? 'selected' : ''}}>{{$state->state}}</option>
                    @endforeach
                </select>

                @error('state_id')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="description" :value="__('Description')" />
                <textarea name="description" id="description">{{$project->description}}</textarea>
            </div>

            <div class="mt-2">
                <input class="w-full p-2 bg-green-600 hover:bg-green-800" type="submit" value="{{__('Update')}}" />
            </div>
        </form>

        <a class="block rounded w-auto mt-2 p-2 text-center text-white bg-red-600 hover:bg-red-800" href="{{route('projects.show', $project)}}">{{__('Cancel')}}</a>
    </div>
@endsection
