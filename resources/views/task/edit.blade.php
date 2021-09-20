@extends('layouts.app')

@section('content')
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.crud-alert', ['model' => \App\Models\Task::class])
                <div class="card">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        @include('task.partials.form')
                    </div>
                </div>
                @include('task.partials.task-media')
            </div>
        </div>
    </div>
@endsection
