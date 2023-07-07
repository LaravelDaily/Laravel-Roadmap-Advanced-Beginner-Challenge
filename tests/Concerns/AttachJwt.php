<?php

namespace Tests\Concerns;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

trait AttachJwt
{
    public function generateToken(User $user)
    {
        return JWTAuth::fromUser($user);
    }

    public function baseUri(string $token, string $model = '', string $addUri = '')
    {
        return '/api/' . $model . 's/' . $addUri . '?token=' . $token;
    }
}
