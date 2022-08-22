@extends('app')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <h5 class="card-header">Users Table</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($users as $user)
                        <tr class="table-default">
                            <td><i class="fab fa-sketch fa-lg text-warning me-3"></i> <strong>{{ $user->name }}</strong>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                    <div
                                        class="avatar avatar-l pull-up" title="Lilian Fuller">
                                        <img src="{{ $user->getFirstMediaUrl('avatar', 'thumb-38') ? $user->getFirstMediaUrl('avatar', 'thumb-38') : asset('assets/img/avatars/avatardefault.png') }}" alt="Avatar" class="rounded-circle" />
                                    </div>
                            </td>
                            <td> <span class="badge {{ $user->roles->pluck('name')[0] === 'admin' ? 'bg-label-success' : 'bg-label-primary' }}  me-1">
                                {{ $user->roles->pluck('name')[0];  }}</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('users.edit',$user->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('users.destroy',$user->id) }}" method="post">
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
                            <td colspan="4">No users found</td>
                        </tr>
                        @endforelse
                       
                    </tbody>
                   
                </table>
                <div class="m-3">
                    {{ $users->links() }}
                </div>
                
            </div>
        </div>
    </div>
    <!--/ Contextual Classes -->
    <div class="content-backdrop fade"></div>
</div>

@push('scripts')
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
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
@endpush

@endsection
