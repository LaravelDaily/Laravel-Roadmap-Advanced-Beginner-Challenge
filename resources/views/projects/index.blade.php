<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of projects') }}
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
                                        {{__('Title')}}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('Company')}}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('Project manager')}}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('Status')}}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('Due date')}}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__('Nr. of tasks')}}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3 text-right">
                                        @if(Auth::user()->hasRole('admin'))
                                            <a href="/projects/create"
                                               class="bg-gray-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                {{__('Add new')}}
                                            </a>
                                        @else
                                            {{__('Not entitled to create')}}
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                @if(count($projects)>0)
                                    <tbody>
                                    <!-- Odd row -->
                                    @foreach($projects as $project)
                                        <tr class="@if($loop->index%2==0)bg-white @else bg-gray-50 @endif">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{$project->title}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{$project->client->name}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{$project->assignedTo->name}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <x-is-active status="{{$project->status}}"></x-is-active>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{$project->due_date}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{$project->tasks_count}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                @if( Auth::user()->hasRole('admin') ||
                                                    (Auth::user()->hasRole('user') && in_array((int) Auth::id(),[(int) $project->created_by,(int) $project->user_id]))
                                                    )

                                                    <a href="{{url('/projects/'.$project->id.'/edit')}}"
                                                       class="text-indigo-600 hover:text-indigo-900 inline-flex">{{__('Edit')}}</a>
                                                    &nbsp;
                                                    @if($project->tasks->count()==0)
                                                        <form action="{{url('/projects',[$project])}}" method="POST"
                                                              class=" inline-flex">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    onclick="return confirm('{{__('Are You sure?')}}');"
                                                                    class="text-red-600 hover:text-red-900">{{__('Delete')}}</button>
                                                        </form>
                                                    @endif
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
                                        {{$projects->links()}}
                                    </td>
                                    </th>
                                    </tfoot>
                                @else
                                    <tr class="bg-yellow-300">
                                        <td colspan="7"
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{__('No projects found.')}}
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
