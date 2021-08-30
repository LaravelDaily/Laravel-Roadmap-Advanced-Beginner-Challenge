@extends('layouts.crm')

@section('main')
    <div class="rounded w-10/12 mx-auto mt-5 bg-white p-5">
        @if(session('message'))
            <div class="block w-full m-2 p-3 rounded border border-green-900 bg-green-500 text-center text-white">
                {{session('message')}}
            </div>
        @endif

        <h2>Users</h2>

        <table>
            <thead>
            <tr class="border-b-4 border-indigo-900">
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr class="border-b-2 border-indigo-700">
                    <td class="py-3 px-2">{{$user->name}}</td>
                    <td class="py-3 px-2">{{$user->email}}</td>
                    <td class="py-3 px-2">
                        @if($user->roles->pluck('name')->contains('user'))
                            <span>user</span>
                        @elseif($user->roles->pluck('name')->contains('admin'))
                            <span>admin</span>
                        @elseif($user->roles->pluck('name')->contains('Super-Admin'))
                            <span>superadmin</span>
                        @else
                            <span>Any role assigned...</span>
                        @endif
                    </td>
                    <td class="py-3 px-2">
                        @can('update users')
                            <x-action-button :href="route('users.edit', $user)" type="edit">
                                {{__('Edit')}}
                            </x-action-button>
                        @endcan

                        @can('delete users')
                                <form action="{{route('users.destroy', $user)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this user?')">
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
