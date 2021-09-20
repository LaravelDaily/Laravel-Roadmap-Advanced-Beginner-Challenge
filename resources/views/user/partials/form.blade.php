<form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" method="POST">
    @if(isset($user)) @method('PUT') @endif
    @csrf

    <div class="form-group">
        <label>Name</label>
        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
               value="{{ old('name') ?? $user->name ?? '' }}" required>
        @error('name')
        <div class="invalid-feedback">
            @foreach($errors->get('name') as $message)
                {{ $message }}
            @endforeach
        </div>
        @endif
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
               value="{{ old('email') ?? $user->email ?? '' }}" required>
        @error('email')
        <div class="invalid-feedback">
            @foreach($errors->get('email') as $message)
                {{ $message }}
            @endforeach
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password"
               minlength="8">
        @error('password')
        <div class="invalid-feedback">
            @foreach($errors->get('password') as $message)
                {{ $message }}
            @endforeach
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Password confirmation</label>
        <input class="form-control" name="password_confirmation" type="password" minlength="8">
    </div>
    @can('assignAdminRole', $user ?? \App\Models\User::class)
        <div class="custom-control custom-switch mb-3">
            <input name="is_admin" type="hidden" value="0">
            <input id="is_admin" class="custom-control-input" name="is_admin" type="checkbox" value="1"
                   @if(isset($user) && $user->isAdmin()) checked @endif>
            <label class="custom-control-label" for="is_admin">Is admin</label>
        </div>
    @endcan
    <button class="btn btn-primary" type="submit">Save</button>
</form>
