@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <script type="text/javascript">
        $(function () {

            $('.datepicker').datepicker();
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

@endpush


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new project') }}
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
            <form action="{{url('/projects')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="created_by"/>
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6 grid grid-cols-6 gap-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('project information') }}</h3>
                            <p class="mt-1 text-sm text-gray-500">projects data</p>
                        </div>

                        <div class="col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                {{__('Title')}}</label>
                            <input type="text" name="title" id="title"
                                   autocomplete="off" value="{{old('title')}}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <x-has-error input="title"></x-has-error>
                        </div>
                        <div class="col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                {{__('Description')}}</label>
                            <textarea name="description" id="description"
                                      autocomplete="off"
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{old('description')}}</textarea>
                            <x-has-error input="description"></x-has-error>
                        </div>
                        <div class="col-span-6 sm:col-span-3 relative  input-group date">
                            <label for="due_date"
                                   class=" block text-sm font-medium text-gray-700">{{__('Due date')}}</label>
                            <input type="text" name="due_date" id="due_date" autocomplete="off"
                                   value="{{old('due_date')}}"
                                   class="datepicker mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <x-has-error input="due_date"></x-has-error>
                        </div>

                        <div class="col-span-6 sm:col-span-3 ">
                            <label for="status" class="block text-sm font-medium text-gray-700">{{__('Status')}}</label>
                            <select id="status" name="status"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">{{__(' - select - ')}}</option>
                                <option value="0" @if(old('status')=="0") selected @endif >Open</option>
                                <option value="1" @if(old('status')=="1") selected @endif >Closed</option>
                            </select>
                            <x-has-error input="status"></x-has-error>
                        </div>
                        <div class="col-span-6 sm:col-span-3 ">
                            <label for="user_id"
                                   class="block text-sm font-medium text-gray-700">{{__('Project manager')}}</label>

                            <select id="user_id" name="user_id"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">{{__(' - select - ')}}</option>
                                @forelse($users as $id=>$name)
                                    <option value="{{$id}}" @if(old('user_id')==$id) selected @endif >
                                        {{$name}}</option>
                                @empty
                                    <option value="">{{__(' - no user found - ')}}</option>
                                @endforelse
                            </select>
                            <x-has-error input="user_id"></x-has-error>
                        </div>
                        <div class="col-span-6 sm:col-span-3 ">
                            <label for="client_id"
                                   class="block text-sm font-medium text-gray-700">{{__('Client')}}</label>
                            <select id="client_id" name="client_id" @if(request()->client) disabled @endif
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @if(request()->client) bg-gray-400 @endif">
                                <option value="">{{__(' - select - ')}}</option>
                                @forelse($clients as $id=>$name)
                                    <option value="{{$id}}" @if(old('client_id',request()->client)==$id) selected @endif >
                                        {{$name}}</option>
                                @empty
                                    <option value="">{{__(' - no client found - ')}}</option>
                                @endforelse
                            </select>
                            @if(request()->client) <input type="hidden" name="client_id" value="{{request()->client}}"> @endif
                            <x-has-error input="client_id"></x-has-error>
                        </div>
                        <div class="col-span-6">
                            <label for="logo" class="block text-sm font-medium text-gray-700">
                                {{__('Logo')}}</label>
                            <input type="file" name="logo" id="logo"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <x-has-error input="logo"></x-has-error>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <x-error-count></x-error-count>
                    <a href="/projects" onclick='return confirm("{{__("Really don't save?")}}");'
                       class="bg-gray-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        {{__('Cancel')}}
                    </a>
                    <button type="submit"
                            class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{__('Save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
