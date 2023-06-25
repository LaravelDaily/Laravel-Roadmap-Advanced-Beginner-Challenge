@extends('crm.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create client</h1>
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
                        <form action="{{ route('crm.client.store') }}" method="POST" class="w-25">
                            @csrf
                            <label for="name_manager">Manager name</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="name_manager" name="name_manager" placeholder="manager name">
                            </div>

                            <label for="email_manager">Manager email</label>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email_manager" name="email_manager" placeholder="manager email">
                            </div>

                            <label for="phone_manager">Manager phone number</label>
                            <div class="form-group">
                                <input type="tel" class="form-control" id="phone_manager" name="phone_manager" placeholder="manager phone number">
                            </div>

                            <label for="title_company">Company name</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="title_company" name="title_company" placeholder="company name">
                            </div>

                            <label for="description_company">Company description</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="description_company" name="description_company" placeholder="company description">
                            </div>

                            <label for="city_company">Company city</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="city_company" name="city_company" placeholder="company city">
                            </div>

                            <label for="address_company">Company address</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="address_company" name="address_company" placeholder="company address">
                            </div>

                            <label for="vat_company">Company vat</label>
                            <div class="form-group">
                                <input type="number" class="form-control" id="vat_company" name="vat_company" placeholder="company vat" min="0">
                            </div>

                            <label for="zip_company">Company zip</label>
                            <div class="form-group">
                                <input type="number" class="form-control" id="zip_company" name="zip_company" placeholder="company zip" min="0">
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
