@extends('layouts.app')

@section('content')
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.crud-alert', ['model' => \App\Models\Project::class])
                <div class="card">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        @include('project.partials.form')
                    </div>
                </div>
                @include('project.partials.project-media')
            </div>
        </div>
    </div>
@endsection
