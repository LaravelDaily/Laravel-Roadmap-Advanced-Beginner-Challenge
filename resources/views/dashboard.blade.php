@extends('layouts.crm')

@section('main')
    <div class="rounded w-10/12 mx-auto mt-5 bg-white p-5">
        @if(session('message'))
            <div class="block w-full m-2 p-3 rounded border border-green-900 bg-green-500 text-center text-white">
                {{session('message')}}
            </div>
        @endif

        <h2>Dashboard</h2>

        <div class="w-full flex flex-row flex-wrap justify-center">
            <a href="{{route('clients.index')}}" class="rounded-md w-2/4 m-2 p-5 border border-green-500 text-center text-green-600">
                <span class="block text-4xl font-bold">{{count($clients)}}</span>
                <p>{{__('Active clients')}}</p>
            </a>

            <a href="{{route('projects.index')}}" class="rounded-md w-2/4 m-2 p-5 border border-yellow-500 text-center text-yellow-600">
                <span class="block text-4xl font-bold">{{count($projects)}}</span>
                <p>{{__('Active projects')}}</p>
            </a>

            <a href="{{route('tasks.index')}}" class="rounded-md w-2/4 m-2 p-5 border border-purple-500 text-center text-purple-600">
                <span class="block text-4xl font-bold">{{count($tasks)}}</span>
                <p>{{__('Active tasks')}}</p>
            </a>
        </div>
    </div>
@endsection
