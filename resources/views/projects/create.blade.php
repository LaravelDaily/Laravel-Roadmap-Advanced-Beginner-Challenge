<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{route('projects.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" id="title" value="{{old('title')}}" name="title"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Company Name" required/>
                            @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{$message}}</span></p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="4" required
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                      placeholder="Write your thoughts here...">{{old('description')}}</textarea>
                            @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{$message}}</span></p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="deadline" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deadline</label>
                            <input type="date" id="deadline" value="{{old('deadline')}}" name="deadline"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Deadline" required/>
                            @error('deadline')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{$message}}</span></p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="users" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assigned User</label>
                            <select id="users" required name="user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>Choose a user</option>
                                @forelse($users as $userId => $userName)
                                    <option value="{{$userId}}" @selected(old('name') === $userName)>{{ucfirst($userName)}}</option>
                                @empty
                                    <option selected>There is no user to assign</option>
                                @endforelse
                            </select>
                            @error('user')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$message}}</span></p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="clients" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assigned Client</label>
                            <select id="clients" required name="client" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>Choose a client</option>
                                @forelse($clients as $clientId => $companyName)
                                    <option value="{{$clientId}}" @selected(old('client') === $clientId)>{{ucfirst($companyName)}}</option>
                                @empty
                                    <option selected>There is no client to assign</option>
                                @endforelse
                            </select>
                            @error('client')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$message}}</span></p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status" required name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>Choose a status</option>
                                    <option value="0" @selected(old('status') === 0)>{{__('Open')}}</option>
                                    <option value="1" @selected(old('status') === 1)>{{__('Close')}}</option>
                            </select>
                            @error('status')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$message}}</span></p>
                            @enderror
                        </div>
                        <div class="text-right">
                            <a href="{{route('projects.index')}}"
                               class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
