@extends('crm.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create task</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('crm.task.store') }}" method="POST" class="w-50">
                            @csrf
                            <label for="title">Title</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ old('title') }}" placeholder="task title">
                            </div>

                            <label for="description">Description</label>
                            <div class="form-group">
                                <textarea type="text" class="form-control" id="description" name="description" placeholder="description">{{ old('description') }}</textarea>
                            </div>

                            <label for="priority">Priority</label>
                            <div class="form-group">
                                <input type="number" class="form-control" id="priority" name="priority"
                                       value="{{ old('title') }}" placeholder="priority" min="0" max="5">
                            </div>

                            <label for="client">Client</label>
                            <div class="form-group">
                                <select name="client_id" id="client" class="form-control">
                                    @foreach($clients as $client)
                                        <option
                                            {{ old('client_id') === $client->id ? ' selected' : '' }}
                                            value="{{ $client->id }}">{{ $client->title_company }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="user">Assigned user</label>
                            <div class="form-group">
                                <select name="user_id" id="user" class="form-control">
                                    @foreach($users as $user)
                                        <option
                                            {{ old('name') === $user->id ? ' selected' : '' }}
                                            value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="project">Project</label>
                            <div class="form-group">
                                <select name="project_id" id="project" class="form-control">
                                    @foreach($projects as $project)
                                        <option
                                            {{ old('project') === $project->id ? ' selected' : '' }}
                                            value="{{ $project->id }}">{{ $project->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="status">Status</label>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control">
                                    @foreach($statuses as $status=>$value)
                                        <option value="{{ $status }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Create">
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
