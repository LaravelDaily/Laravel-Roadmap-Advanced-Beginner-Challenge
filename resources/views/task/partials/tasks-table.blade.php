<div class="table-responsive">
    <table class="table table-borderless table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Project</th>
            <th>Client</th>
            <th>User</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            @if(request()->routeIs('task.deleted'))
                <th>Deleted</th>
            @endif
            @if(request()->routeIs('task.index', 'task.deleted'))
                <th>Actions</th>
            @endif
        </tr>
        </thead>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>
                    <a href="{{ route('task.show', $task->id) }}">
                        {{ $task->title }}
                    </a>
                </td>
                <td>{{ $task->project->title ?? '' }}</td>
                <td>{{ $task->project->client->company ?? '' }}</td>
                <td>{{ $task->project->user->name ?? '' }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->created_at }}</td>
                <td>{{ $task->updated_at }}</td>
                @if(request()->routeIs('task.deleted'))
                    <td>{{ $task->deleted_at }}</td>
                @endif
                @if(request()->routeIs('task.index', 'task.deleted'))
                    <td class="text-nowrap">
                        @if(request()->routeIs('task.index'))
                            @can('update', $task)
                                <a class="btn btn-secondary btn-sm"
                                   href="{{ route('task.edit', $task->id) }}">
                                    <i class="cil-pencil"></i>
                                </a>
                            @endcan
                            @can('delete', $task)
                                <form class="d-inline-block" action="{{ route('task.destroy', $task->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-light btn-sm" type="submit"
                                            onclick="return confirm('Are you sure you want to delete?');">
                                        <i class="cil-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        @elseif(request()->routeIs('task.deleted'))
                            @can('restore', $task)
                                <form class="d-inline-block" action="{{ route('task.restore', $task->id) }}"
                                      method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit"
                                            onclick="return confirm('Are you sure you want to restore?');">
                                        <i class="cil-reload"></i>
                                    </button>
                                </form>
                            @endcan
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
</div>
