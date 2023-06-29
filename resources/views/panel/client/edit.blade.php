@extends('client-layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                @if (session('msg'))
                    <div class="alert alert-success text-center rounded-0">
                        <span>{{ session('msg') }}</span>
                    </div>
                @endif
                <div class="card-body">
                    <div class="card-title">
                        <h5>Create Project</h5>
                        <hr>
                    </div>
                    <form action="{{ route('clients.update', $client->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="company" class="form-label mb-2">Company</label>
                        <input type="text" name="company" class="form-control mb-3" value="{{ $client->company }}">
                        @error('company')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="vat" class="form-label mb-2">Vat</label>
                        <input type="number" name="vat" class="form-control mb-3" value="{{ $client->vat }}">
                        @error('vat')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="address" class="form-label mb-2">Address</label>
                        <input type="text" name="address" class="form-control mb-3" value="{{ $client->address }}">
                        @error('address')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


