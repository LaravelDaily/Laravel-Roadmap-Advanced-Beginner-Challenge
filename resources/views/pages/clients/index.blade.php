@extends('app')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <h5 class="card-header">Clients Table</h5>
            <div class="px-3">
                <a href="{{ route('clients.create') }}" type="button" class="btn btn-dark">
                    Craete &nbsp; <span class="tf-icons bx bx-user-pin"></span>
                  </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Vat</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($clients as $client)
                        <tr class="table-default">
                            <td><i class="fab fa-sketch fa-lg text-warning me-3"></i> <strong>{{ $client->company_name }}</strong>
                            </td>
                            <td>{{ $client->company_vat }}</td>
                            <td>{{ $client->company_address }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('clients.edit',$client->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('clients.destroy',$client->id) }}" method="post">
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
                            <td colspan="4">No Client found</td>
                        </tr>
                        @endforelse
                       
                    </tbody>
                   
                </table>
                <div class="m-3">
                    {{ $clients->links() }}
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
            title: 'Are you sure you want to delete this client?',
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
