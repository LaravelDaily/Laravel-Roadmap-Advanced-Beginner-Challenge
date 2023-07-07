@if($message = flash()->get())
    <div class="{{ $message->class() }} p-2">
        {{ $message->message() }}
    </div>
@endif
