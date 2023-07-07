<?php

namespace App\Http\Controllers\Swagger\V1;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/tasks",
 *     summary="Create",
 *     tags={"Task"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="title", type="string", example="title example"),
 *                     @OA\Property(property="description", type="string", example="description example"),
 *                     @OA\Property(property="priority", type="integer", example=2),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="user_id", type="integer", example=2),
 *                     @OA\Property(property="client_id", type="integer", example=2),
 *                     @OA\Property(property="project_id", type="integer", example=2),
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
 *                     @OA\Property(property="title", type="string", example="title example"),
 *                     @OA\Property(property="description", type="string", example="description example"),
 *                     @OA\Property(property="priority", type="integer", example=2),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="user_id", type="integer", example=2),
 *                     @OA\Property(property="client_id", type="integer", example=2),
 *                     @OA\Property(property="project_id", type="integer", example=2),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/tasks",
 *     summary="Index",
 *     tags={"Task"},
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
 *                     @OA\Property(property="priority", type="integer", example=2),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="client_id", type="integer", example=2),
 *                     @OA\Property(property="user_id", type="integer", example=2),
 *                     @OA\Property(property="project_id", type="integer", example=2),
 *             )),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/tasks/{task}",
 *     summary="Show",
 *     tags={"Task"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Task's id",
 *         in="path",
 *         name="task",
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
 *                     @OA\Property(property="priority", type="integer", example=2),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="client_id", type="integer", example=2),
 *                     @OA\Property(property="user_id", type="integer", example=2),
 *                     @OA\Property(property="project_id", type="integer", example=2),
 *             )),
 *         ),
 *     ),
 * ),
 *
 *
 * @OA\Patch(
 *     path="/api/tasks/{task}",
 *     summary="Update",
 *     tags={"Task"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Task's id",
 *         in="path",
 *         name="task",
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
 *                     @OA\Property(property="priority", type="integer", example=2),
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
 *                     @OA\Property(property="priority", type="integer", example=2),
 *                     @OA\Property(property="status", type="string", example="active"),
 *                     @OA\Property(property="user_id", type="integer", example=2),
 *                     @OA\Property(property="client_id", type="integer", example=2),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Delete(
 *     path="/api/tasks/{task}",
 *     summary="Delete",
 *     tags={"Task"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Task's id",
 *         in="path",
 *         name="task",
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
class TaskController extends Controller
{

}
