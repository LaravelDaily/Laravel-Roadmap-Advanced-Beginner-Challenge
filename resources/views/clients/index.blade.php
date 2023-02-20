@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('clients.create') }}">
                <button type="button" class="btn btn-success mb-2">
                    <svg class="icon">
                        <use xlink:href="{{asset('svg/free.svg#cil-plus')}}"></use>
                    </svg> Add
                </button>
            </a>
            <div class="card">
                <div class="card-header">{{ __('Clients') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Company</th>
                                <th scope="col">VAT</th>
                                <th scope="col">Status</th>
                                <th scope="col">Projects</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->company }}</td>
                                <td>{{ $client->vat }}</td>
                                <td>{!! $client->status ? '<span class="badge text-bg-success">Active</span>':'<span class="badge text-bg-danger">Not Active</span>' !!}</td>
                                <td><span class="badge rounded-pill text-bg-info">{{ $client->projects_count }}</span></td>
                                <td> <a href="{{ route('clients.edit',$client->id) }}" class="btn btn-info mr-1"><svg class="icon">
                                            <use xlink:href="{{asset('svg/free.svg#cil-pencil')}}"></use>
                                        </svg> Edit </a>
                                    <form action="{{route('clients.destroy',$client->id)}}" method="POST" style="all:unset">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><svg class="icon">
                                                <use xlink:href="{{asset('svg/free.svg#cil-trash')}}"></use>
                                            </svg> Delete </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $clients->links('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection