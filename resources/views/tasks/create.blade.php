<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new task to project') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <ul class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-red-700 text-white font-extrabold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{url('/tasks')}}" method="POST">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('task description') }}</h3>
                            <p class="mt-1 text-sm text-gray-500">tasks data</p>
                        </div>

                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3 ">
                                <label for="project_id"
                                       class="block text-sm font-medium text-gray-700">{{__('Project')}}</label>
                                <select id="project_id" name="project_id" @if(request()->project) disabled @endif
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @if(request()->project) bg-gray-400 @endif">
                                    <option value="">{{__(' - select - ')}}</option>
                                    @forelse($projects as $id=>$name)
                                        <option value="{{$id}}" @if(old('project_id',request()->project)==$id) selected @endif >
                                            {{$name}}</option>
                                    @empty
                                        <option value="">{{__(' - no project found - ')}}</option>
                                    @endforelse
                                </select>
                                @if(request()->project) <input type="hidden" name="project_id" value="{{request()->project}}"> @endif
                                <x-has-error input="project_id"></x-has-error>
                            </div>

                            <div class="col-span-6 ">
                                <label for="name"
                                       class="block text-sm font-medium text-gray-700">{{__('Title')}}</label>
                                <input type="text" name="title" id="title" autocomplete="off"
                                       value="{{old('name')}}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <x-has-error input="title"></x-has-error>
                            </div>

                            <div class="col-span-6 ">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    {{__('Description')}}</label>
                                <textarea name="description" id="description"
                                          autocomplete="off"
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{old('description')}}</textarea>
                                <x-has-error input="description"></x-has-error>
                            </div>


                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-error-count></x-error-count>
                        <a href="/tasks"
                           onclick='return confirm("{{__("Really don't save?")}}");'
                           class="bg-gray-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            {{__('Cancel')}}
                        </a>
                        <button type="submit"
                                class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{__('Save')}}
                        </button>
                    </div>
                </div>
            </form>

            </div>

        </div>
    </div>

</x-app-layout>
