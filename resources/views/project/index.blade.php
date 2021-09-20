@extends('layouts.app')

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                @include('partials.crud-alert', ['model' => \App\Models\Project::class])
                <div class="card m-0">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                        {{ $title }}
                        @include('partials.table-filter', ['modelStatuses' => \App\Models\Project::$statuses])
                    </div>
                    <div class="card-body">
                        @include('project.partials.projects-table')
                    </div>
                    @if($projects->hasPages())
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                {{ $projects->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
