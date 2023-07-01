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

    public function baseUri(string $token, string $addUri = '')
    {
        return '/api/clients/' . $addUri . '?token=' . $token;
    }
}
