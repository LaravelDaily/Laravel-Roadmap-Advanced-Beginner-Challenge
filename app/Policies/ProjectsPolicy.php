<?php

namespace App\Policies;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectsPolicy
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
        return $user->can('list-project');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Projects $projects)
    {
        return $user->can('show-project');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create-project');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Projects $projects)
    {
        return $user->can('edit-project');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Projects $projects)
    {
        return $user->can('delete-project');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Projects $projects)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Projects $projects)
    {
        //
    }
}
