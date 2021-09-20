<form id="project-form" action="{{ isset($project) ? route('project.update', $project->id) : route('project.store') }}"
      method="POST">
    @if(isset($project)) @method('PUT') @endif
    @csrf

    <div class="form-group">
        <label>Title</label>
        <input class="form-control @error('title') is-invalid @enderror" name="title" type="text"
               value="{{ old('title') ?? $project->title ?? '' }}" required>
        @error('title')
        <div class="invalid-feedback">
            @foreach($errors->get('title') as $message)
                {{ $message }}
            @endforeach
        </div>
        @endif
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                  required>{{ old('description') ?? $project->description ?? '' }}</textarea>
        @error('description')
        <div class="invalid-feedback">
            @foreach($errors->get('description') as $message)
                {{ $message }}
            @endforeach
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Deadline</label>
        <input class="form-control @error('deadline') is-invalid @enderror" name="deadline" type="date"
               value="{{ $project->deadline ?? '' }}" required>
        @error('deadline')
        <div class="invalid-feedback">
            @foreach($errors->get('deadline') as $message)
                {{ $message }}
            @endforeach
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Client</label>
        <select class="form-control @error('client_id') is-invalid @enderror" name="client_id" required>
            <option value="">Select client</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}"
                        @if(isset($project->client->id) && $project->client->id === $client->id) selected @endif>
                    {{ $client->company }}
                </option>
            @endforeach
        </select>
        @error('client_id')
        <div class="invalid-feedback">
            @foreach($errors->get('client_id') as $message)
                {{ $message }}
            @endforeach
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Assigned user</label>
        <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" required>
            <option value="">Select user</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}"
                        @if(isset($project->user->id) && $project->user->id === $user->id) selected @endif>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('user_id')
        <div class="invalid-feedback">
            @foreach($errors->get('user_id') as $message)
                {{ $message }}
            @endforeach
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Status</label>
        <select class="form-control @error('status_id') is-invalid @enderror" name="status_id" required>
            <option value="">Select status</option>
            @foreach(\App\Models\Project::$statuses as $id => $status)
                <option value="{{ $id }}"
                        @if(isset($project->status_id) && $project->status_id === $id) selected @endif>
                    {{ $status }}
                </option>
            @endforeach
        </select>
        @error('status_id')
        <div class="invalid-feedback">
            @foreach($errors->get('status_id') as $message)
                {{ $message }}
            @endforeach
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Media upload</label>
        <div class="dropzone"></div>
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>

@include('partials.form-media-upload-script', ['formId' => '#project-form'])
