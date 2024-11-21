<x-app-layout>
    <x-slot name="header">
        {{ __('User') }}
    </x-slot>

    <div class="sm:px-6 md:px-0 lg:px-0 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('users.partials.update-user-information-form')
            </div>
        </div>
    </div>
</x-app-layout>