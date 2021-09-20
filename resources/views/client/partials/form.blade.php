<form action="{{ isset($client) ? route('client.update', $client->id) : route('client.store') }}" method="POST">
    @if(isset($client)) @method('PUT') @endif
    @csrf

    @if(session('updated'))
        <div class="alert alert-success" role="alert">
            Client updated!
        </div>
    @endif

    <div class="form-group">
        <label>Company</label>
        <input class="form-control @error('company') is-invalid @enderror" name="company" type="text"
               value="{{ old('company') ?? $client->company ?? '' }}" required>
        @error('company')
        <div class="invalid-feedback">
            @foreach($errors->get('company') as $message)
                {{ $message }}
            @endforeach
        </div>
        @endif
    </div>
    <div class="form-group">
        <label>VAT</label>
        <input class="form-control @error('vat') is-invalid @enderror" name="vat" type="text"
               value="{{ old('vat') ?? $client->vat ?? '' }}" required>
        @error('vat')
        <div class="invalid-feedback">
            @foreach($errors->get('vat') as $message)
                {{ $message }}
            @endforeach
        </div>
        @endif
    </div>
    <div class="form-group">
        <label>Address</label>
        <input class="form-control @error('address') is-invalid @enderror" name="address" type="text"
               value="{{ old('address') ?? $client->address ?? '' }}" required>
        @error('address')
        <div class="invalid-feedback">
            @foreach($errors->get('address') as $message)
                {{ $message }}
            @endforeach
        </div>
        @endif
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
