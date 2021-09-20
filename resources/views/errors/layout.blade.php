@extends('layouts.app', compact('title'))

@section('content')
    <div class="container my-5">
        <div class="alert alert-danger" role="alert">
            {{ $code }} | {{ $title ?: __($exception->getMessage()) }}
        </div>
    </div>
@endsection
