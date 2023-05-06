@extends('layouts.app');
@section('content')

<div class="container">
    <div class="row">
<div class="input-group mb-3">
    <form method="post" action="/updateprofile/{{ $user->id }}" enctype="multipart/form-data">
        @csrf
    <input type="file" class="form-control" id="inputGroupFile02" name="profile_image">

        <button class="btn btn-success" type="submit"> upload </button>
    </form>
</div>
    </div>
</div>
@endsection
