<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' created new User: ' . $user->id . '. ' . $user->name);
        }

        flash()->info('User created: ' . $user->name);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' updated User: ' . $user->id . '. ' . $user->name);
        }

        flash()->info('User updated: ' . $user->name);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' deleted User: ' . $user->id . '. ' . $user->name);
        }

        flash()->info('User deleted: ' . $user->name);
    }

}
