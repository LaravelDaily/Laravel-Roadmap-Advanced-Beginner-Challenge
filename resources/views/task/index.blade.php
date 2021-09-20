@extends('layouts.app')

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                @include('partials.crud-alert', ['model' => \App\Models\Task::class])
                <div class="card m-0">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                        {{ $title }}
                        @include('partials.table-filter', ['modelStatuses' => \App\Models\Task::$statuses])
                    </div>
                    <div class="card-body">
                        @include('task.partials.tasks-table')
                    </div>
                    @if($tasks->hasPages())
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                {{ $tasks->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
