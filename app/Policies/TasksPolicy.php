<?php

namespace App\Policies;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TasksPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('list-task');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Tasks $tasks)
    {
        return $user->can('show-task');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create-task');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Tasks $tasks)
    {
        return $user->can('edit-task');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Tasks $tasks)
    {
        return $user->can('delete-task');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Tasks $tasks)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Tasks $tasks)
    {
        //
    }
}
