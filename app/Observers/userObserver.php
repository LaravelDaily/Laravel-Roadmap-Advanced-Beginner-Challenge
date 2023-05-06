<?php

namespace App\Observers;

use App\Models\User;

class userObserver
{
    /**
     * Handle the CLient "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
//        $user->notify(new WelcomeMailNotifcation());
    }

    /**
     * Handle the CLient "updated" event.
     *
     * @param  \App\Models\CLient  $cLient
     * @return void
     */
    public function updated(CLient $cLient)
    {
        //
    }

    /**
     * Handle the CLient "deleted" event.
     *
     * @param  \App\Models\CLient  $cLient
     * @return void
     */
    public function deleted(CLient $cLient)
    {
        //
    }

    /**
     * Handle the CLient "restored" event.
     *
     * @param  \App\Models\CLient  $cLient
     * @return void
     */
    public function restored(CLient $cLient)
    {
        //
    }

    /**
     * Handle the CLient "force deleted" event.
     *
     * @param  \App\Models\CLient  $cLient
     * @return void
     */
    public function forceDeleted(CLient $cLient)
    {
        //
    }
}
