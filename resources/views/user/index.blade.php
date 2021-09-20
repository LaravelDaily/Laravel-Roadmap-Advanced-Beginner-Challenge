@extends('layouts.app')

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                @include('partials.crud-alert', ['model' => \App\Models\User::class])
                <div class="card m-0">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        @include('user.partials.users-table')
                    </div>
                    @if($users->hasPages())
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                {{ $users->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
