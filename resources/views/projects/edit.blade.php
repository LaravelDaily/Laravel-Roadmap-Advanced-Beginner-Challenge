@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('edit Project') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="row g-3 needs-validation" action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="col-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $project->title }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="10">{{ $project->description }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="vat" class="form-label">Deadline</label>
                            <input type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" value="{{ $project->deadline }}" name="deadline">
                            @error('deadline')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="user_id" class="form-label">Assigned User</label>
                            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $project->user_id? 'selected':'' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="clients" class="form-label">Assigned Clients</label>
                            <select class="form-select form-control @error('clients') is-invalid @enderror" id="multiple-select-field" name="clients[]" data-placeholder="Choose clients" multiple>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}"  {{ in_array($client->id,$project->clients()->pluck('id')->toArray()) ? 'selected':'' }}>{{ $client->company }}</option>
                                @endforeach
                            </select>
                            @error('clients')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                <option value="1"  {{  $project->status ? 'selected':'' }}>Open</option>
                                <option value="0"  {{  $project->status == 0 ? 'selected':'' }}>Closed</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

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