@extends('crm.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex align-items-center">
                        <h1 class="m-0 mr-2">{{ $project->title }}</h1>
                        <a href="{{ route('crm.project.edit', compact('project')) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                        <form action="{{ route('crm.project.destroy', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border-0 bg-transparent">
                                <i class="fas fa-trash text-danger" role="button"></i>
                            </button>
                        </form>
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
                    <div class="col-6 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Project</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{ $project->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Project title</td>
                                        <td>{{ $project->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Project description</td>
                                        <td>{{ $project->description }}</td>
                                    </tr>
                                    <tr>
                                        <td>Project deadline</td>
                                        <td>{{ $project->deadline }}</td>
                                    </tr>
                                    <tr>
                                        <td>Project client</td>
                                        <td>{{ $project->client->title_company }}</td>
                                    </tr>
                                    <tr>
                                        <td>Project user</td>
                                        <td>{{ $project->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Project status</td>
                                        <td>{{ $project->status }}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
