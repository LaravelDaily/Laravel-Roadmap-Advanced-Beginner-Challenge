<?php

namespace App\Http\Controllers\Swagger\V1;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/projects",
 *     summary="Create",
 *     tags={"Project"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="title", type="string", example="title example"),
 *                     @OA\Property(property="description", type="string", example="description example"),
 *                     @OA\Property(property="deadline", type="date", example="2023-07-18"),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="user_id", type="integer", example=2),
 *                     @OA\Property(property="client_id", type="integer", example=2),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="title example"),
 *                     @OA\Property(property="description", type="string", example="description example"),
 *                     @OA\Property(property="deadline", type="date", example="2023-07-18"),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="user_id", type="integer", example=2),
 *                     @OA\Property(property="client_id", type="integer", example=2),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/projects",
 *     summary="Index",
 *     tags={"Project"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="title example"),
 *                     @OA\Property(property="description", type="string", example="description example"),
 *                     @OA\Property(property="deadline", type="date", example="2023-07-18"),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="client", type="array", @OA\Items(
 *                          @OA\Property(property="id", type="integer", example=1),
 *                          @OA\Property(property="title", type="string", example="title example"),
 *                          @OA\Property(property="description", type="string", example="descr example"),
 *                          @OA\Property(property="vat", type="integer", example=123),
 *                          @OA\Property(property="zip", type="integer", example=123),
 *                          @OA\Property(property="name", type="string", example="name example"),
 *                          @OA\Property(property="email", type="string", example="mail@mail.com"),
 *                          @OA\Property(property="phone", type="string", example="+7958473891"),
 *                          @OA\Property(property="address", type="string", example="Lenina, 10"),
 *                          @OA\Property(property="city", type="string", example="Moscow"),
 *                     )),
 *                     @OA\Property(property="user", type="array", @OA\Items(
 *                          @OA\Property(property="id", type="integer", example=1),
 *                          @OA\Property(property="name", type="string", example="name example"),
 *                          @OA\Property(property="email", type="string", example="mail@example.com"),
 *                          @OA\Property(property="role", type="string", example="manager"),
 *                     )),
 *             )),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/projects/{project}",
 *     summary="Show",
 *     tags={"Project"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Project's id",
 *         in="path",
 *         name="project",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="title example"),
 *                     @OA\Property(property="description", type="string", example="description example"),
 *                     @OA\Property(property="deadline", type="date", example="2023-07-18"),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="client", type="array", @OA\Items(
 *                          @OA\Property(property="id", type="integer", example=1),
 *                          @OA\Property(property="title", type="string", example="title example"),
 *                          @OA\Property(property="description", type="string", example="descr example"),
 *                          @OA\Property(property="vat", type="integer", example=123),
 *                          @OA\Property(property="zip", type="integer", example=123),
 *                          @OA\Property(property="name", type="string", example="name example"),
 *                          @OA\Property(property="email", type="string", example="mail@mail.com"),
 *                          @OA\Property(property="phone", type="string", example="+7958473891"),
 *                          @OA\Property(property="address", type="string", example="Lenina, 10"),
 *                          @OA\Property(property="city", type="string", example="Moscow"),
 *                     )),
 *                     @OA\Property(property="user", type="array", @OA\Items(
 *                          @OA\Property(property="id", type="integer", example=1),
 *                          @OA\Property(property="name", type="string", example="name example"),
 *                          @OA\Property(property="email", type="string", example="mail@example.com"),
 *                          @OA\Property(property="role", type="string", example="manager"),
 *                     )),
 *             )),
 *         ),
 *     ),
 * ),
 *
 *
 * @OA\Patch(
 *     path="/api/projects/{project}",
 *     summary="Update",
 *     tags={"Project"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Project's id",
 *         in="path",
 *         name="project",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="title example"),
 *                     @OA\Property(property="description", type="string", example="description example"),
 *                     @OA\Property(property="deadline", type="date", example="2023-07-18"),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="user_id", type="integer", example=2),
 *                     @OA\Property(property="client_id", type="integer", example=2),
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
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="title example"),
 *                     @OA\Property(property="description", type="string", example="description example"),
 *                     @OA\Property(property="deadline", type="date", example="2023-07-18"),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="user_id", type="integer", example=2),
 *                     @OA\Property(property="client_id", type="integer", example=2),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Delete(
 *     path="/api/projects/{project}",
 *     summary="Delete",
 *     tags={"Project"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Project's id",
 *         in="path",
 *         name="project",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="deleted"),
 *         ),
 *     ),
 * ),
 */
class ProjectController extends Controller
{

}
