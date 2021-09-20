<?php

namespace App\Policies;

use App\Models\Response;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Response $response)
    {
        return $user->isAdmin() || $user->hasPermissionTo('response-delete');
    }
}
