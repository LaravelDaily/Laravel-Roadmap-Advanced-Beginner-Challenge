@extends('layouts.app')

@section('content')
    <a href="{{ route('clients.create') }}" class="btn btn-success mb-3">Create client</a>
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">first Name</th>
                <th scope="col">last Name</th>
                <th scope="col">Company</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Country</th>
                <th scope="col">Client status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <th scope="row ">{{ $client->id }}</th>
                    <td>{{ $client->first_name }}</td>
                    <td>{{ $client->last_name }}</td>
                    <td>{{ $client->company }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->country }}</td>
                    <td>{{ $client->client_status }}</td>
                    <td class="d-flex align-items-center mt-1">
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary me-2">Edit</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="">
        {{ $clients->links() }}
    </div>
@endsection
