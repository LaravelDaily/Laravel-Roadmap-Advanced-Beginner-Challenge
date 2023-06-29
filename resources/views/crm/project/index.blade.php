@extends('crm.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Projects</h1>
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
                    <div class="col-2">
                        <a href="{{ route('crm.project.create') }}" class="btn btn-block btn-primary">Add</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Projects</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Deadline</th>
                                        <th>Client</th>
                                        <th>Status</th>
                                        <th colspan="3" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            <td>{{ $project->title }}</td>
                                            <td>{{ $project->client->title_company }}</td>
                                            <td>{{ $project->deadline }}</td>
                                            <td>{{ $project->status }}</td>
                                            <td class="text-center"><a href="{{ route('crm.project.show', $project->id) }}"><i class="far fa-eye"></i></a></td>
                                            <td class="text-center"><a href="{{ route('crm.project.edit', $project->id) }}" class="text-success"><i class="fas fa-pencil-alt"></i></a></td>
                                            <td class="text-center">
                                                <form action="{{ route('crm.project.destroy', $project->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-transparent">
                                                        <i class="fas fa-trash text-danger" role="button"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="row mt-5">
        <div class="mx-auto" style="margin-top: -100px">
            {{ $projects->withQueryString()->links() }}
        </div>
    </div>
@endsection
