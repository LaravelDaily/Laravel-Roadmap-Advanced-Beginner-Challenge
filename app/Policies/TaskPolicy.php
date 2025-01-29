<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
      /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): Response
    {
        return  $user->hasRole('admin') || $user->id == $task->user_id
                ? Response::allow()
                : Response::deny('You can not delete this task.');
    }
    
    public function update(User $user, Task $task): Response
    {
        return  $user->hasRole('admin') || $user->id == $task->user_id
                ? Response::allow()
                : Response::deny('You can not delete this task.');
    }
}
