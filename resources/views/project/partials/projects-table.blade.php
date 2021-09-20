<div class="table-responsive">
    <table class="table table-borderless table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Deadline</th>
            <th>Client</th>
            <th>User</th>
            <th>Tasks</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            @if(request()->routeIs('project.deleted'))
                <th>Deleted</th>
            @endif
            @if(request()->routeIs('project.index', 'project.deleted'))
                <th>Actions</th>
            @endif
        </tr>
        </thead>
        @foreach($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>
                    <a href="{{ route('project.show', $project->id) }}">
                        {{ $project->title }}
                    </a>
                </td>
                <td>{{ $project->deadline_inverted }}</td>
                <td>{{ $project->client->company ?? '' }}</td>
                <td>{{ $project->user->name ?? '' }}</td>
                <td>{{ $project->tasks_count }}</td>
                <td>{{ $project->status }}</td>
                <td>{{ $project->created_at }}</td>
                <td>{{ $project->updated_at }}</td>
                @if(request()->routeIs('project.deleted'))
                    <td>{{ $project->deleted_at }}</td>
                @endif
                @if(request()->routeIs('project.index', 'project.deleted'))
                    <td class="text-nowrap">
                        @if(request()->routeIs('project.index'))
                            @can('update', $project)
                                <a class="btn btn-secondary btn-sm"
                                   href="{{ route('project.edit', $project->id) }}">
                                    <i class="cil-pencil"></i>
                                </a>
                            @endcan
                            @can('delete', $project)
                                <form class="d-inline-block" action="{{ route('project.destroy', $project->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-light btn-sm" type="submit"
                                            onclick="return confirm('Are you sure you want to delete?');">
                                        <i class="cil-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        @elseif(request()->routeIs('project.deleted'))
                            @can('restore', $project)
                                <form class="d-inline-block" action="{{ route('project.restore', $project->id) }}"
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
