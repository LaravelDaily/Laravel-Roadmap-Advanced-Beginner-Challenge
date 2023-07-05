@extends('notifications-layout.app')

@section('content')
    <div class="row">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h5 class="display-6">
                Notifications
            </h5>
            <div>
                <form action="{{ route('notification.read', auth()->id()) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">Mark all As Read</button>
                </form>
            </div>
        </div>
            <div class="col-12">
                @foreach($notifications as $notification)
                    <div class="alert alert-light shadow-sm d-flex justify-content-between align-items-center">
                        <div>
                            <span>{{ $notification->data['name'] }} [{{ $notification->data['email'] }}] as just registered for a new account.</span>
                            <br>
                        </div>
                        <div>
                            <span>{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@endsection
