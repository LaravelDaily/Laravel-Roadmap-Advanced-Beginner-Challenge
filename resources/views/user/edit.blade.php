@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.crud-alert', ['model' => \App\Models\User::class])
                <div class="card">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        @include('user.partials.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
