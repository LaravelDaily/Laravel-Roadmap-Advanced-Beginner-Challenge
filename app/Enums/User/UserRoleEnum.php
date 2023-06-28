<?php

namespace App\Enums\User;

enum UserRoleEnum: string
{
    case Admin = 'admin';
    case Manager = 'manager';
}
