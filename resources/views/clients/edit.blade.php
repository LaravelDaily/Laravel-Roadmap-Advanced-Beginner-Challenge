@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Edit client') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="row g-3 needs-validation" action="{{ route('clients.update', $client->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="company" class="form-label">Company Name</label>
                            <input type="company" class="form-control @error('company') is-invalid @enderror" name="company" id="company" value="{{ $client->company }}">
                            @error('company')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="10">{{ $client->description }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="vat" class="form-label">VAT</label>
                            <input type="number" class="form-control @error('vat') is-invalid @enderror" name="vat" id="vat" value="{{ $client->vat }}">
                            @error('vat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="status" class="form-label">Status</label>
                            <div class="btn-group m-2 @error('status') is-invalid @enderror" role="group">  
                                <input type="radio" class="btn-check" name="status" value="1" id="btnradio1" autocomplete="off" {{ $client->status == true ? "checked":"" }}>
                                <label class="btn btn-outline-primary" for="btnradio1">Active</label>

                                <input type="radio" class="btn-check" value="0" name="status" id="btnradio2" autocomplete="off" {{ $client->status == false ? "checked":"" }}>
                                <label class="btn btn-outline-primary" for="btnradio2">Not Active</label>
                            </div>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="projects" class="form-label">Projects</label>
                        </div>
                        <select class="form-select form-control" id="multiple-select-field" name="projects[]"  data-placeholder="Choose project" multiple>
                            @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ in_array($project->id,$client->projects()->pluck('id')->toArray()) ? "selected":"" }}>{{ $project->title }}</option>
                            @endforeach
                        </select>

                        <div class="col-12">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection