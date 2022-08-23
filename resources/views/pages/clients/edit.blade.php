@extends('app')
@section('title', __('Edit Client'))
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Update Client Info</span></h4>

        <div class="row">
            <div class="col-md-12">
              <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('clients.update',$client->id) }}">
                  @csrf
                  @method('PUT')
                    <div class="card mb-4">
                      <h4 class="px-3">Client Info</h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name" autofocus
                                        value="{{ $client->name }}" />
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                    value="{{ $client->email }}">
                                </div>
                                <div class="mb-3 col-md-8">
                                  <label for="phone_number" class="form-label">Phone Number</label>
                                  <input class="form-control" type="text" id="phone_number" name="phone_number"
                                  value="{{ $client->phone_number }}">
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                      <h4 class="px-3">Company Info</h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="company_name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="company_name" name="company_name" autofocus
                                    value="{{ $client->company_name }}" />
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="company_address" class="form-label">Address</label>
                                    <input class="form-control" type="text" id="company_address" name="company_address"
                                    value="{{ $client->company_address }}">
                                </div>
                                <div class="mb-3 col-md-8">
                                  <label for="company_city" class="form-label">City</label>
                                  <input class="form-control" type="text" id="company_city" name="company_city"
                                  value="{{ $client->company_city }}">
                                </div>
                                <div class="mb-3 col-md-8">
                                  <label for="company_zip" class="form-label">Zip Code</label>
                                  <input class="form-control" type="text" id="company_zip" name="company_zip"
                                  value="{{ $client->company_zip }}">
                                </div>
                                <div class="mb-3 col-md-8">
                                  <label for="company_vat" class="form-label">VAT</label>
                                  <input class="form-control" type="number" id="company_vat" name="company_vat"
                                  value="{{ $client->company_vat }}">
                                </div>
                            </div>
                            <div class="mt-2">
                              <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                          </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->


    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection
