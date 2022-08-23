@extends('app')
@section('title', __('Edit Profile'))
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings</span></h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Change Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $user->getFirstMediaUrl('avatar', 'thumb-38')  
                            ? $user->getFirstMediaUrl('avatar', 'thumb-38') 
                            : asset('assets/img/avatars/avatardefault.png') }}"
                                alt="user-avatar" class="d-block rounded" height="100" width="100"
                                id="uploadedAvatar" />
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('users.update',$user->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-8">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ $user->name }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $user->email }}">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="avatar" class="form-label">Avatar</label>
                                    <input class="form-control" type="file" id="avatar" name="avatar">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('users.update.passowrd',$user->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Current Password</label>
                                <input class="form-control" type="text" name="old_password" id="old_password"
                                    placeholder="Current Passowrd" value="{{ old('old_password') }}" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password_confirmation">Confirm New Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" class="form-control"
                                        name="password_confirmation"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->


    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection
