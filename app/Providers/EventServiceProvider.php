<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Observers\ClientObserver;
use App\Observers\ProjectObserver;
use App\Observers\TaskObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Client::observe(ClientObserver::class);
        Project::observe(ProjectObserver::class);
        Task::observe(TaskObserver::class);
        User::observe(UserObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
