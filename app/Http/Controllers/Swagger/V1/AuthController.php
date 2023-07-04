<?php

namespace App\Http\Controllers\Swagger\V1;

use App\Http\Controllers\Controller;


/**
 * @OA\Post(
 *     path="/api/auth/login",
 *     summary="Login",
 *     tags={"Auth"},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="email", type="string", example="email@mail.com"),
 *                     @OA\Property(property="password", type="string", example="password"),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="access_token", type="integer", example=1),
 *                 @OA\Property(property="token_type", type="string", example="Some title"),
 *             ),
 *         ),
 *     ),
 * ),
 *
 */

class AuthController extends Controller
{

}
