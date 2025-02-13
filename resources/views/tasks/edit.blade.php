a<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action={{ route('tasks.update', $task) }}>
                        @csrf
                        @method('patch')
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input :value="old('name', $task->title)" id="title"
                                        class="block mt-1 w-full" type="text" name="title" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />

                                </div>
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-input :value="old('description', $task->description)" id="description"
                                        class="block mt-1 w-full" type="description" name="description" />
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />

                                </div>
                                <div>
                                    <x-input-label for="user_id" :value="__('User')" />
                                    <select name="user_id" id="user_id"
                                        class="form-control mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @selected($task->user_id == $user->id)>
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </option>
                                         @endforeach
                                    </select> 
                                </div>
                                <div>
                                    <x-input-label for="project_id" :value="__('Project')" />
                                    <select name="project_id" id="project_id"
                                        class="form-control mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" @selected($task->project_id == $project->id)>
                                                {{ $project->title }}
                                            </option>
                                         @endforeach
                                    </select> 
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
                                    <input name="deadline" id="datepicker-autohide" datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="old('name', $project->deadline)"
                                    placeholder="Select deadline date">
                                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />

                                </div> 
                                <div>
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select name="status" id="status"
                                        class="form-control mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                                        @foreach ($statuses as $value)
                                        <option old=$status value="{{$value}}">
                                            {{$value}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Edit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>