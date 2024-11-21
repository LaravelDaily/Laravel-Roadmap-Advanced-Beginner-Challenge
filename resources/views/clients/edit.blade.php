a<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action={{ route('clients.store') }}>
                        @csrf
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input :value="old('name', $client->name)" id="name"
                                        class="block mt-1 w-full" type="text" name="name" />
                                </div>
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input :value="old('email', $client->email)" id="email"
                                        class="block mt-1 w-full" type="email" name="email" />
                                </div>
                                <div>
                                    <x-input-label for="company" :value="__('Company')" />
                                    <select name="company_id" id="company_id"
                                        class="form-control mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                                        @foreach ($companies as $company)

                                        <option value="{{$company->id}}" {{ o company_id')==$company->id ?
                                            'selected'
                                            : '' }}>{{$company->name}}</option>


                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input :value="old('email', $client->email)" id="phone"
                                        class="block mt-1 w-full" type="text" name="phone" />
                                </div>
                                <div>
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select name="status" id="status"
                                        class="form-control mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">
                                        $statuses
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