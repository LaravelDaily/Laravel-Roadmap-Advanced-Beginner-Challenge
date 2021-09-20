<form id="task-form" action="{{ isset($task) ? route('task.update', $task->id) : route('task.store') }}" method="POST">
    @if(isset($task)) @method('PUT') @endif
    @csrf

    <div class="form-group">
        <label>Title</label>
        <input class="form-control @error('title') is-invalid @enderror" name="title" type="text"
               value="{{ old('title') ?? $task->title ?? '' }}" required>
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
                  required>{{ old('description') ?? $task->description ?? '' }}</textarea>
        @error('description')
        <div class="invalid-feedback">
            @foreach($errors->get('description') as $message)
                {{ $message }}
            @endforeach
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Project</label>
        <select class="form-control @error('project_id') is-invalid @enderror" name="project_id" required>
            <option>Select project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}"
                        @if(isset($task->project->id) && $task->project->id === $project->id) selected @endif>
                    {{ $project->title }}
                </option>
            @endforeach
        </select>
        @error('project_id')
        <div class="invalid-feedback">
            @foreach($errors->get('project_id') as $message)
                {{ $message }}
            @endforeach
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Status</label>
        <select class="form-control @error('status_id') is-invalid @enderror" name="status_id" required>
            <option>Select status</option>
            @foreach(\App\Models\Task::$statuses as $id => $status)
                <option value="{{ $id }}" @if(isset($task->status_id) && $task->status_id === $id) selected @endif>
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

@include('partials.form-media-upload-script', ['formId' => '#task-form'])
