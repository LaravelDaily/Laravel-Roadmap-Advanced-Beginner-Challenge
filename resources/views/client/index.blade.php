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

        <h2>Clients</h2>

        @can('create clients')
            <a class="block p-3 w-36 mb-5 rounded text-white text-center bg-green-600 hover:bg-green-800 cursor-pointer" href="{{route('clients.create')}}">{{__('Create client')}}</a>
        @endcan

        <div class="mb-5">
            <a class="p-3 w-36 rounded text-white text-center bg-gray-400 hover:bg-gray-500 cursor-pointer" href="{{route('clients.show', 'active')}}">{{__('Show active')}}</a>

            <a class="p-3 w-36 rounded text-white text-center bg-gray-400 hover:bg-gray-500 cursor-pointer" href="{{route('clients.show', 'inactive')}}">{{__('Show inactive')}}</a>
        </div>

        <table>
            <thead>
            <tr class="border-b-4 border-indigo-900">
                    <th>Company</th>
                    <th> VAT</th>
                    <th> Address</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($clients as $client)
                    <tr class="border-b-2 border-indigo-700 {{$client->active ? '' : 'bg-gray-200'}}">
                        <td class="py-3 px-2">{{$client->name}}</td>
                        <td class="py-3 px-2">{{$client->vat}}</td>
                        <td class="py-3 px-2">{{$client->address}}</td>
                        <td class="py-3 px-2">
                            @can('update clients')
                                <x-action-button :href="route('clients.edit', $client)" type="edit">
                                    {{__('Edit')}}
                                </x-action-button>
                            @endcan

                            @can('delete clients')
                                <form action="{{route('clients.destroy', $client)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this client?')">
                                    @csrf
                                    @method('DELETE')

                                    <input class="p-3 w-24 bg-red-600 hover:bg-red-800" type="submit" value="{{__('Delete')}}" />
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
