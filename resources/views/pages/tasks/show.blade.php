@extends('app')
@section('title', __('View Task'))
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Project Details</h4>
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <h5 class="card-header">Client Info</h5>
                    <div class="card-body">
                        <hr>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-5 col-12 mb-3 mb-md-0">
                                    <div class="list-group">
                                        <a class="list-group-item list-group-item-action active" id="list-name-list"
                                            data-bs-toggle="list" href="#list-name">Name</a>
                                        <a class="list-group-item list-group-item-action" id="list-email-list"
                                            data-bs-toggle="list" href="#list-email">Email</a>
                                        <a class="list-group-item list-group-item-action" id="list-phone-list"
                                            data-bs-toggle="list" href="#list-phone">Phone</a>
                                        <a class="list-group-item list-group-item-action" id="list-c-name-list"
                                            data-bs-toggle="list" href="#list-c-name">Company Name</a>
                                        <a class="list-group-item list-group-item-action" id="list-c-address-list"
                                            data-bs-toggle="list" href="#list-c-address">Company Address</a>
                                    </div>
                                </div>
                                <div class="col-md-7 col-12">
                                    <div class="tab-content p-0">
                                        <div class="tab-pane fade active show" id="list-name">
                                            {{ $project->client->name }}
                                        </div>
                                        <div class="tab-pane fade " id="list-email">
                                            {{ $project->client->email }}
                                        </div>
                                        <div class="tab-pane fade" id="list-phone">
                                            {{ $project->client->phone_number }}
                                        </div>
                                        <div class="tab-pane fade" id="list-c-name">
                                            {{ $project->client->company_name }}
                                        </div>
                                        <div class="tab-pane fade" id="list-c-address">
                                            {{ $project->client->company_address }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card mb-4">
                    <h5 class="card-header">Assigned To User Info</h5>
                    <div class="card-body">
                        <hr>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-4 col-12 mb-3 mb-md-0">
                                    <div class="list-group">
                                        <a class="list-group-item list-group-item-action active" id="list-u-name-list"
                                            data-bs-toggle="list" href="#list-u-name">Name</a>
                                        <a class="list-group-item list-group-item-action" id="list-u-email-list"
                                            data-bs-toggle="list" href="#list-u-email">Email</a>
                                        <a class="list-group-item list-group-item-action" id="list-u-role-list"
                                            data-bs-toggle="list" href="#list-u-role">Role</a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="tab-content p-0">
                                        <div class="tab-pane fade active show" id="list-u-name">
                                            {{ $project->user->name }}
                                        </div>
                                        <div class="tab-pane fade" id="list-u-email">
                                            {{ $project->user->email }}
                                        </div>
                                        <div class="tab-pane fade" id="list-u-role">
                                            <span
                                                class="badge bg-label-dark me-1">{{ $project->user->roles->first()->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Display headings -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <h5 class="card-header">Title : {{ $project->title }}</h5>
                    <hr>
                    <div class="p-3">
                        <p>Description : {{ $project->description }}</p>
                    </div>
                </div>
            </div>
            <!-- Paragraph -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <h5 class="card-header">Dates</h5>
                    <hr>
                    <div class="card-body">
                        <p class="mb-0 mt-0">Srart Date : {{ $project->created_at }}</p>
                        <p class="mb-0">Deadline : {{ $project->deadline_format }}</p>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="fw-bold py-3 mb-4">Task Detail</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <h5 class="card-header">Title : {{ $task->title }}</h5>
                    <hr>
                    <div class="p-3">
                        <p>Description : {{ $task->description }}</p>
                    </div>
                </div>
            </div>
            <!-- Paragraph -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <h5 class="card-header">Dates</h5>
                    <hr>
                    <div class="card-body">
                        <p class="mb-0 mt-0">Srart Date : {{ $task->created_at }}</p>
                        <p class="mb-0">Update Date : {{ $task->updated_at }}</p>
                        <p class="mb-0">Deadline : {{ $task->deadline_format }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="content-backdrop fade"></div>
    </div>
</div>
<!-- Content wrapper -->
@endsection
