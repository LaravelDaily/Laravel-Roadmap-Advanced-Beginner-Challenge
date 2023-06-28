<?php

namespace App\QueryBuilders\User;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function whereUserRole($role)
    {
        return $this->where('role', $role);
    }
}
