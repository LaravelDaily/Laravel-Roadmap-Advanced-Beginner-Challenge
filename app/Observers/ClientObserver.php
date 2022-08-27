<?php

namespace App\Observers;

use App\Models\Clients;
use App\Models\User;
use App\Notifications\SystemNotifications;
use Illuminate\Support\Facades\Notification;
class ClientObserver
{
    public $admin;

    public function __construct()
    {
        $this->admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
    }


    /**
     * Handle the Clients "created" event.
     *
     * @param  \App\Models\Clients  $clients
     * @return void
     */
    public function created(Clients $clients)
    {
        $client = [
            'name' => $clients->company_name,
            'type' => 'Registered',
            'message' => 'New Company Registered',
            'icon' => 'user-pin',
            'color' => 'info',
        ];
        Notification::send($this->admin , new SystemNotifications($client));
    }

    /**
     * Handle the Clients "updated" event.
     *
     * @param  \App\Models\Clients  $clients
     * @return void
     */
    public function updated(Clients $clients)
    {
        $client = [
            'name' => $clients->company_name,
            'type' => 'Updated',
            'message' => 'Registered Company Updated',
            'icon' => 'user-pin',
            'color' => 'warning',
        ];
        Notification::send($this->admin , new SystemNotifications($client));
    }

    /**
     * Handle the Clients "deleted" event.
     *
     * @param  \App\Models\Clients  $clients
     * @return void
     */
    public function deleted(Clients $clients)
    {
        $client = [
            'name' => $clients->company_name,
            'type' => 'Deleted',
            'message' => 'Registered Company Deleted',
            'icon' => 'user-pin',
            'color' => 'danger',
        ];
        Notification::send($this->admin , new SystemNotifications($client));
    }

    /**
     * Handle the Clients "restored" event.
     *
     * @param  \App\Models\Clients  $clients
     * @return void
     */
    public function restored(Clients $clients)
    {
        //
    }

    /**
     * Handle the Clients "force deleted" event.
     *
     * @param  \App\Models\Clients  $clients
     * @return void
     */
    public function forceDeleted(Clients $clients)
    {
        //
    }
}
