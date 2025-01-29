<x-app-layout>
    <x-slot name="header">
        {{ __('Tasks') }}
    </x-slot>
    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class=" mb-4 rounded-lg">
        <a href="{{ route('tasks.create') }}">
            <x-primary-button> {{ __('Create Task') }}</x-primary-button>
        </a>
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Deadline</th>
                            <th class="px-4 py-3">Assigned User</th>
                            <th class="px-4 py-3">Client</th>
                            <th class="px-4 py-3">Project</th>
                            <th class="px-4 py-3">Created at</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($tasks as $task)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ $task->title }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->description }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->status }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->deadline }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->user->first_name ?? null }} {{ $task->user->last_name ?? null }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->project->client->name ?? null }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ ! empty($task->project) ? $task->project->title : ''}}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->created_at }}
                            </td>
                            
                            @cannot('delete', $task)
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                    @csrf
                                    @method('delete')
                                    <a class="text-red-600 hover:text-red-900" :href="route('tasks.destroy', $task)"
                                        onclick="event.preventDefault(); this.closest('form').submit();">Delete</a>
                                </form>
                            </td>
                            @endcannot
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>