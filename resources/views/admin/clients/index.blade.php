@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="row">
                <div class="col-md-6 p-0">
                    <a href="{{ route('admin.clients.create') }}" class="btn btn-success ">Create Client</a>
                </div>
              </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Company</th>
                    <th>VAT</th>
                    <th>Address</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($clients as $client)

                    <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->vat }}</td>
                    <td>{{ $client->adress }}</td>
                    <td>
                        <a href='{{ route('admin.clients.edit', ['client' => $client->id]) }}' class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button  class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection
