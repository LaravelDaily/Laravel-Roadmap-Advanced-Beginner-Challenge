<?php


namespace App\Observers;

use App\Models\Client;
use App\Notifications\ClientCreatedNotification;
use Auth;

class ClientObserver
{
    /**
     * Handle the Client "created" event.
     *
     * @param \App\Models\Client $client
     * @return void
     */
    public function saving(Client $client)
    {
        switch (request()->method()) {
            case 'POST':
                $client['created_by'] = $client['created_by'] ?? Auth::id();
                Auth::user()->notify(new ClientCreatedNotification($client));
                break;
            case 'PUT':
                $client['updated_by'] = $client['updated_by'] ?? Auth::id();
                break;
            case 'DELETE':
                $client['deleted_by'] = $client['deleted_by'] ?? Auth::id();
                break;
        }

    }
}
