<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $clients = Client::take(3)->get();
        return view('panel.index', compact('clients', 'unreadNotifications'));
    }

    public function notifications(){
        $notifications = auth()->user()->notifications;
        $unreadNotifications = auth()->user()->unreadNotifications;
        return view('panel.notifications.index', compact('notifications', 'unreadNotifications'));
    }

    public function readNotifications(string $id)
    {
        $user = User::find($id);
        $user->unreadNotifications->markAsRead();

        return redirect()->route('notification.index');
    }

}
