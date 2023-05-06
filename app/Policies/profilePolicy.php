<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class profilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function showProfile(){
        return true;
    }
    public function editprofileimage(User $user,$id){
//        return ( $user->can('edit profile image') or ( $user->id == $id));
        return $user->id == $id;

    }

}
