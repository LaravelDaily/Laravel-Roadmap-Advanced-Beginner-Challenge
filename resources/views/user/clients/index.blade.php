@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @can('Super Admin')
            <div class="row">
                <div class="col-md-6 p-0">
                    <a href="{{ route('user.clients.create') }}" class="btn btn-success ">Create Client</a>
                </div>
            </div>
            @endcan
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Company</th>
                    <th>VAT</th>
                    <th>Address</th>
                    @can('Super Admin')
                        <th>Action</th>
                    @endcan
                    </tr>
                </thead>
                <tbody>

                    @foreach ($clients as $client)

                    <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->vat }}</td>
                    <td>{{ $client->adress }}</td>
                    @can('Super Admin')
                    <td>
                        <a href='{{ route('user.clients.edit', ['client' => $client->id]) }}' class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('user.clients.destroy', $client->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button  class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                    @endcan
                    </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection
