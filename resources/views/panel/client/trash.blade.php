@extends('client-layout.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('clients.index') }}" class="btn btn-primary">Show All Clients
            <i class="bi bi-person"></i>
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
                    <h5 class="card-title">Recycle Bin</h5>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Company</th>
                            <th>VAT</th>
                            <th>Address</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($trashedClient as $client)
                            <tr>
                                <td>{{ $client->company }}</td>
                                <td>{{ $client->vat }}</td>
                                <td>{{ $client->address }}</td>
                                <td class="d-flex align-item-center">
                                    <form action="{{ route('clients.restore', $client->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm me-2">Restore</button>
                                    </form>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $trashedClient->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
