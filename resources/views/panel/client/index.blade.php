@extends('client-layout.app')

@section('content')
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <a href="{{ route('clients.create')  }}" class="btn btn-primary">Create Client
                <i class="bi bi-plus"></i>
            </a>
            <a href="{{ route('clients.trash') }}" class="btn btn-primary p-2">
                Recycle Bin <i class="bi bi-trash"></i>
                @if ($clientTrashed->count() > 0)
                    <span class="badge bg-danger ms-1 rounded-circle">{{ $clientTrashed->count() }}</span>
                @endif
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    @if (session('msg'))
                        <div class="alert alert-success text-center rounded-0">
                            <span>{{ session('msg') }}</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Clients List</h5>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Company</th>
                                <th>VAT</th>
                                <th>Address</th>
                                <th>Became Client on</th>
                                <th>Client User</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->company }}</td>
                                    <td>{{ $client->vat }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>{{ $client->created_at }}</td>
                                    <td>{{ $client->clientable->name }}</td>
                                    <td class="d-flex align-item-center"><a href={{ route('clients.edit', $client->id) }}
                                            class="btn btn-success btn-sm me-2">Edit</a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endsection


