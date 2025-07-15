<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- This example requires Tailwind CSS v2.0+ -->

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        @if(session('message'))
                            <ul class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-green-700 text-white font-extrabold">
                                <li>{{ session('message') }}</li>
                            </ul>
                        @endif
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('Project')}}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('Title')}}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3 text-right">
                                            <a href="/tasks/create"
                                               class="bg-gray-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                {{__('Add new')}}
                                            </a>
                                    </th>
                                </tr>
                                </thead>
                                @if(count($tasks)>0)
                                    <tbody>
                                    <!-- Odd row -->
                                    @foreach($tasks as $task)
                                        <tr class="@if($loop->index%2==0)bg-white @else bg-gray-50 @endif">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{$task->project->title}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{$task->title}}

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                @if(Auth::user()->hasRole('admin') ||
                                                    (Auth::user()->hasRole('user') && (int) Auth::id() === (int) $task->created_by))

                                                    <a href="{{url('/tasks/'.$task->id.'/edit')}}"
                                                       class="text-indigo-600 hover:text-indigo-900 inline-flex">{{__('Edit')}}</a> &nbsp;

                                                        <form action="{{url('/tasks',[$task])}}" method="POST" class=" inline-flex">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    onclick="return confirm('{{__('Are You sure?')}}');"
                                                                    class="text-red-600 hover:text-red-900">{{__('Delete')}}</button>
                                                        </form>
                                                @else
                                                    {{__('Not entitled to edit / delete')}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <th>
                                    <td colspan="5"
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{$tasks->links()}}
                                    </td>
                                    </th>
                                    </tfoot>
                                @else
                                    <tr class="bg-yellow-300">
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{__('No tasks found.')}}
                                        </td>
                                    </tr>
                            @endif
                            <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
