<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\SystemNotifications;
use Illuminate\Support\Facades\Notification;
class UserObserver
{

    public $admin;

    public function __construct()
    {
        $this->admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->assignRole('user');
        $user->save();
        $NewUser = [
            'name' => $user->name,
            'type' => 'Registered',
            'message' => 'New User Registered',
            'icon' => 'user',
            'color' => 'info',
        ];
        Notification::send($this->admin , new SystemNotifications($NewUser));
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
