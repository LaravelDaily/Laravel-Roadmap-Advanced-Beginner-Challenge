@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h2>Kiki CRM <span class="text-primary">Panel</span></h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <span>{{ auth()->user()->name }},</span>
                        {{ __('before proceeding please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-white rounded-pill mt-5 shadow-sm" type="submit">Logout</button>
        </form>
    </div>
@endsection
