<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />

                                </div>
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" />
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />

                                </div>
                                <div>
                                    <x-input-label for="user_id" :value="__('User')" />
                                    <select name="user_id" id="user_id" aria-placeholder="user"
                                        class="form-control mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">
                                            {{$user->first_name}}  {{$user->last_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="project_id" :value="__('Project')" />
                                    <select name="project_id" id="project" aria-placeholder="project"
                                        class="form-control mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                                        @foreach ($projects as $project)
                                        <option value="{{$project->id}}">
                                            {{$project->title}}  
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-input-label for="deadline" :value="__('Deadline')" />
                                    <div class="relative max-w-sm">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="deadline" id="datepicker-autohide" datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select deadline date">
                                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />

                                </div> 
                            </div>
                        <div>
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select name="status" id="status"
                                        class="form-control mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                                        $statuses
                                        @foreach ($statuses as $value)
                                        <option value="{{$value}}">
                                            {{$value}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />

                                </div>
                            </div>

                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>