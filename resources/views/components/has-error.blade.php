<div>
    @if($errors->has($input))
        <small class="text-red-600">{{ $errors->first($input) }}</small>
    @endif
</div>
