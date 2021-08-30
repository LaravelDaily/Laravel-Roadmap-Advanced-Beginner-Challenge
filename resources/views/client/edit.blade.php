@extends('layouts.crm')

@section('main')
    <div class="rounded w-10/12 mx-auto mt-5 bg-white p-5">
        <h2>{{$client->name}}</h2>

        <form action="{{route('clients.update', $client)}}" method="post">
            @csrf
            @method('PUT')

            <div>
                <x-label for="name" :value="__('Name')" />
                <input id="name" type="text" name="name" value="{{$client->name}}" required />

                @error('name')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="vat" :value="__('VAT')" />
                <input id="vat" type="number" name="vat" value="{{$client->vat}}" required />

                @error('vat')
                    <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div>
                <x-label for="address" :value="__('Address')" />
                <input id="address" type="text" name="address" value="{{$client->address}}" required />

                @error('address')
                <span class="block italic text-red-600">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-2">
                <x-label for="state" :value="__('State')" />
                <select id="state" name="state">
                    <option value="true" {{$client->active ? 'selected' : ''}}>Active</option>
                    <option value="false" {{$client->active ? '' : 'selected'}}>Inactive</option>
                </select>
            </div>

            <div class="mt-2">
                <input class="w-full p-2 bg-green-600 hover:bg-green-800" type="submit" value="{{__('Update')}}" />
            </div>
        </form>

        <a class="block rounded w-auto mt-2 p-2 text-center text-white bg-red-600 hover:bg-red-800" href="{{route('clients.index')}}">{{__('Cancel')}}</a>
    </div>
@endsection
