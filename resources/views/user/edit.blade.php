@extends('layouts.crm')

@section('main')
    <div class="rounded w-10/12 mx-auto mt-5 bg-white p-5">
        <h2>{{$user->name}}</h2>

        <form action="{{route('users.update', $user)}}" method="post">
            @csrf
            @method('PUT')

            <div>
                <x-label for="name" :value="__('Name')" />
                <input id="name" type="text" name="name" value="{{$user->name}}" required />

                @error('name')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="email" :value="__('Email')" />
                <input id="email" type="email" name="email" value="{{$user->email}}" required />

                @error('email')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="role" :value="__('Role')" />
                <select id="role" name="role">
                    <option value="">Assign a role to this user</option>
                    @foreach($roles as $role)
                        <option value="{{$role->name}}" {{$user->roles->pluck('name')->contains($role->name) ? 'selected' : ''}}>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-2">
                <input class="w-full p-2 bg-green-600 hover:bg-green-800" type="submit" value="{{__('Update')}}" />
            </div>
        </form>

        <a class="block rounded w-auto mt-2 p-2 text-center text-white bg-red-600 hover:bg-red-800" href="{{route('users.index')}}">{{__('Cancel')}}</a>
    </div>
@endsection
