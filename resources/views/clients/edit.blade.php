<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit client') }}
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
            @if(session('message'))
                <ul class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-green-700 text-white font-extrabold">
                    <li>{{ session('message') }}</li>
                </ul>
            @endif
            <form action="{{url('/clients/'.$client->id)}}" method="POST">
                @csrf
                @method('PUT')
                <input name="id" value="{{old('id',$client->id)}}" type="hidden"/>
                <input name="created_by" value="{{old('id',$client->created_by)}}" type="hidden"/>
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('Client information') }}</h3>
                            <p class="mt-1 text-sm text-gray-500">Clients data</p>
                        </div>

                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name"
                                       class="block text-sm font-medium text-gray-700">{{__('Company')}}</label>
                                <input type="text" name="name" id="name" autocomplete="off"
                                       value="{{old('name',$client->name)}}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <x-has-error input="name"></x-has-error>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="vat_id"
                                       class="block text-sm font-medium text-gray-700">{{__('VAT')}}</label>
                                <input type="text" name="vat_id" id="vat_id" autocomplete="off"
                                       value="{{old('vat_id',$client->vat_id)}}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <x-has-error input="vat_id"></x-has-error>
                            </div>


                            <div class="col-span-6">
                                <label for="address" class="block text-sm font-medium text-gray-700">
                                    {{__('Street Address')}}</label>
                                <input type="text" name="address" id="address"
                                       autocomplete="off" value="{{old('address',$client->address)}}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <x-has-error input="address"></x-has-error>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="zip_code"
                                       class="block text-sm font-medium text-gray-700">{{__('ZIP / Postal code')}}</label>
                                <input type="text" name="zip_code" id="zip_code" autocomplete="off"
                                       value="{{old('zip_code',$client->zip_code)}}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <x-has-error input="zip_code"></x-has-error>
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="city" class="block text-sm font-medium text-gray-700">{{__('City')}}</label>
                                <input type="text" name="city" id="city" value="{{old('city',$client->city)}}"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <x-has-error input="city"></x-has-error>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-error-count></x-error-count>
                        <a href="/clients"
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

            <div class="mt-10 shadow sm:rounded-md sm:overflow-hidden">
                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                    {{__("Client's projects")}}
                </div>

                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Assigned to')}}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Title')}}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Status')}}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Due date')}}
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                @if(Auth::user()->hasRole('admin'))
                                    <a href="/projects/create?client={{$client->id}}"
                                       class="bg-gray-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        {{__('Add new')}}
                                    </a>
                                @else
                                    {{__('Not entitled to create')}}
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @if(count($client->projects)>0)
                            @foreach($client->projects as $project)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                     src="{{url($project->getMedia('projects')->first()->getUrl('thumb'))}}"
                                                     alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{$project->assignedTo->name}}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{$project->assignedTo->email}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$project->title}}</div>
                                        <div
                                            class="text-sm text-gray-500">{{ \Illuminate\Support\Str::words($project->description,10)}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-is-active status="{{$project->status}}"></x-is-active>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{$project->due_date}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{url('/projects/'.$project->id.'/edit')}}"
                                           class="text-indigo-600 hover:text-indigo-900">{{__('Edit')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-yellow-300">
                                <th class="px-6 py-4 whitespace-nowrap " colspan="5">
                                    {{__("There isn't actually assigned project.")}}
                                </th>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>

</x-app-layout>
