<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User edit page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-200 leading-tight mb-6">
                        {{ __('Information') }}
                    </h2>
                    <form action="{{route('users.update', $user)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                                <input type="text" id="name" name="name" value="{{$user->name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
                            </div>
                            <div class="mb-6">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address:</label>
                                <input type="email" id="email" name="email" value="{{$user->email}}" disabled class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
                            </div>
                        </div>
                        <div>
                            <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-200 leading-tight mb-6">
                                {{ __('Roles & Permissions') }}
                            </h2>
                        </div>
                        <div class="mb-6">
                            <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role:</label>
                            <select id="roles" name="role" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @forelse($roles as $role)
                                <option value="{{$role->id}}" @selected($user->hasRole($role->name))>{{$role->name}}</option>
                                    @empty
                                    <option selected>Roles are not defined</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permissions: </label>
                            @forelse($user->getAllPermissions() as $permission)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300 border border-blue-400">
                                {{$permission->name}}
                            </span>
                                @empty
                                <div class="flex p-2 mb-4 text-sm text-red-800 rounded-lg dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Danger</span>
                                    <div>
                                        <span class="font-medium"> Permissions are not defined</span>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
