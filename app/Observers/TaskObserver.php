<?php

namespace App\Observers;

use App\Models\Task;
use Auth;

class TaskObserver
{
    public function saving(Task $task)
    {
        switch (request()->method()) {
            case 'POST':
                $task['created_by'] = $task['created_by'] ?? Auth::id();
                break;
            case 'PUT':
                $task['updated_by'] = $task['updated_by'] ?? Auth::id();
                break;
            case 'DELETE':
                $task['deleted_by'] = $task['deleted_by'] ?? Auth::id();
                break;
        }

    }
}
