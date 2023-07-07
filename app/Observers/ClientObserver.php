<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Facades\Log;

class ClientObserver
{
    /**
     * Handle the Client "created" event.
     */
    public function created(Client $client): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' created new Client: ' . $client->id . '. ' . $client->title_company);
        }

        flash()->info('Client created: ' . $client->title_company);
    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' updated Client: ' . $client->id . '. ' . $client->title_company);
        }

        flash()->info('Client updated: ' . $client->title_company);
    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' deleted Client: ' . $client->id . '. ' . $client->title_company);
        }

        flash()->info('Client deleted: ' . $client->title_company);
    }

}
