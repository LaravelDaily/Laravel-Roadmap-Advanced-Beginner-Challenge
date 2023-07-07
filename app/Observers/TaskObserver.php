<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' created new Task: ' . $task->id . '. ' . $task->title);
        }

        flash()->info('Task created: ' . $task->title);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' updated Task: ' . $task->id . '. ' . $task->title);
        }

        flash()->info('Task updated: ' . $task->title);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        if (auth()->user() !== null) {
            Log::info('User: ' . auth()->user()->email . ' deleted Task: ' . $task->id . '. ' . $task->title);
        }

        flash()->info('Task deleted: ' . $task->title);
    }

}
