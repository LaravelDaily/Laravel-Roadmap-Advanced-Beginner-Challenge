@extends('layouts.app');
@section('content')
    <h4>username: {{ $user->name }}</h4>

    @if(auth()->check() && auth()->user()->id ==  $user->id  )

<a href="/editprofile/{{ $user->id}}" class="btn btn-primary"> edit profile image </a>

    @endif
@endsection
