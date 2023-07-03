<?php

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' created new Project: ' . $project->id . '. ' . $project->title);
        }

        flash()->info('Project created: ' . $project->title);
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' updated Project: ' . $project->id . '. ' . $project->title);
        }

        flash()->info('Project updated: ' . $project->title);
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' deleted Project: ' . $project->id . '. ' . $project->title);
        }

        flash()->info('Project deleted: ' . $project->title);
    }

}
