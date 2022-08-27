@extends('app')
@section('title', __('Tasks Page'))
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <h5 class="card-header">Tasks Table</h5>
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('tasks.create') }}" type="button" class="btn btn-dark">
                    Craete &nbsp; <span class="tf-icons bx bx-task"></span>
                </a>
         <div class="float-end">
            <label for="defaultSelect" class="form-label">Status </label>
            <select id="defaultSelect" class="form-select">
                <option selected disabled>Select</option>
                <option value="all">All</option>
                <option value="open">Open</option>
                <option value="pending">Pending</option>
                <option value="ongoing">Ongoing</option>
                <option value="completed">Completed</option>
                <option value="canceled">Canceled</option>
              </select>
                  </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Assigned Project</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($tasks as $task)
                        <tr class="table-default">
                            <td><i class="fab fa-sketch fa-lg text-warning me-3"></i>
                                <strong>{{ $task->title }}</strong>
                            </td>
                            <td>{{ $task->project->title }}</td>
                            <td>{{ $task->deadline }}</td>
                            <td><span class="badge bg-label-{{ $task->status }} me-1">{{ $task->status }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('tasks.show',$task->id) }}"><i
                                            class="bx bx-show-alt me-1"></i> Show</a>
                                        <a class="dropdown-item" href="{{ route('tasks.edit',$task->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('tasks.destroy',$task->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item show_confirm"><i
                                                    class="bx bx-trash me-1"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="table-default">
                            <td colspan="4">No Tasks found</td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
                <div class="m-3">
                    {{ $tasks->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    <!--/ Contextual Classes -->
    <div class="content-backdrop fade"></div>
</div>

@push('scripts')
<script type="text/javascript">
    $('.show_confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
    });

</script>
<script>
    $(document).ready(function () {
        $('#defaultSelect').change(function () {
            var status = $(this).val();
            var url = "{{ route('tasks.index') }}";
            window.location.href = url + "?status=" + status;
        });
    });
</script>
@endpush

@endsection
