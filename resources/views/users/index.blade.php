<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <div class=" mb-4 rounded-lg">
            <a href="{{ route('users.create') }}">
                <x-primary-button> {{ __('Create User') }}</x-primary-button>
            </a>
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Address</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Created at</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($users as $user)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                @if(null !== $user->getMedia('images')->first())

                                <img class="w-10 h-10 rounded" src="{{ $user->image() }}" alt="Default avatar">
                                @endisset
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->address }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->phone }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->getRoleNames()->first() }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->created_at }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('users.edit', $user) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="POST" action="{{ route('users.destroy', $user) }}">
                                    @csrf
                                    @method('delete')
                                    <a class="text-red-600 hover:text-red-900" :href="route('users.destroy', $user)"
                                        onclick="event.preventDefault(); this.closest('form').submit();">Delete</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</x-app-layout>