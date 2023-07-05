@extends('project-layout.app')

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
                    <form action="{{ route('project.store') }}" method="POST">
                        @csrf
                        <label for="title" class="form-label mb-2">Title</label>
                        <input type="text" name="title" class="form-control mb-3" value="{{ old('title') }}" />
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="description" class="form-label mb-2">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control mb-3">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control mb-3" value="{{ old('deadline') }}">
                        @error('deadline')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="user_id" class="form-label">Assigned User</label>
                        <select name="user_id" class="form-select mb-3">
                            <option value="">Choose A User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="client_id" class="form-label">Assigned Client</label>
                        <select name="client_id" class="form-select mb-3">
                            <option value="">Choose A Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->company }}</option>
                            @endforeach
                        </select>
                        @error('client_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select mb-3">
                            <option value="">Choose Status</option>
                            <option value="open">Open</option>
                            <option value="close">Close</option>
                        </select>
                        @error('status')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

