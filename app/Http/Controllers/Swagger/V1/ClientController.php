<?php

namespace App\Http\Controllers\Swagger\V1;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/clients",
 *     summary="Create",
 *     tags={"Client"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="title_company", type="string", example="title company example"),
 *                     @OA\Property(property="description_company", type="string", example="description_company"),
 *                     @OA\Property(property="vat_company", type="integer", example=123),
 *                     @OA\Property(property="zip_company", type="integer", example=123),
 *                     @OA\Property(property="name_manager", type="string", example="manager"),
 *                     @OA\Property(property="email_manager", type="string", example="manager@mail.ru"),
 *                     @OA\Property(property="phone_manager", type="string", example="+79559759123"),
 *                     @OA\Property(property="address_company", type="string", example="Lenina 10"),
 *                     @OA\Property(property="city_company", type="string", example="Moscow"),
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
 *                     @OA\Property(property="tittle", type="string", example="title company example"),
 *                     @OA\Property(property="description", type="string", example="description_company"),
 *                     @OA\Property(property="vat", type="integer", example=123),
 *                     @OA\Property(property="zip", type="integer", example=123),
 *                     @OA\Property(property="name", type="string", example="manager"),
 *                     @OA\Property(property="email", type="string", example="manager@mail.ru"),
 *                     @OA\Property(property="phone", type="string", example="+79559759123"),
 *                     @OA\Property(property="address", type="string", example="Lenina 10"),
 *                     @OA\Property(property="city", type="string", example="Moscow"),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/clients",
 *     summary="Index",
 *     tags={"Client"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="tittle", type="string", example="title company example"),
 *                     @OA\Property(property="description", type="string", example="description_company"),
 *                     @OA\Property(property="vat", type="integer", example=123),
 *                     @OA\Property(property="zip", type="integer", example=123),
 *                     @OA\Property(property="name", type="string", example="manager"),
 *                     @OA\Property(property="email", type="string", example="manager@mail.ru"),
 *                     @OA\Property(property="phone", type="string", example="+79559759123"),
 *                     @OA\Property(property="address", type="string", example="Lenina 10"),
 *                     @OA\Property(property="city", type="string", example="Moscow"),
 *             )),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/clients/{client}",
 *     summary="Show",
 *     tags={"Client"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Client's id",
 *         in="path",
 *         name="client",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                     @OA\Property(property="id", type="integer", example="1"),
 *                     @OA\Property(property="title", type="string", example="title company example"),
 *                     @OA\Property(property="description", type="string", example="description_company"),
 *                     @OA\Property(property="vat", type="integer", example=123),
 *                     @OA\Property(property="zip", type="integer", example=123),
 *                     @OA\Property(property="name", type="string", example="manager"),
 *                     @OA\Property(property="email", type="string", example="manager@mail.ru"),
 *                     @OA\Property(property="phone", type="string", example="+79559759123"),
 *                     @OA\Property(property="address", type="string", example="Lenina 10"),
 *                     @OA\Property(property="city", type="string", example="Moscow"),
 *             ),
 *         ),
 *     ),
 * ),
 *
 *
 * @OA\Patch(
 *     path="/api/clients/{client}",
 *     summary="Update",
 *     tags={"Client"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Client's id",
 *         in="path",
 *         name="client",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="title_company", type="string", example="title company example"),
 *                     @OA\Property(property="description_company", type="string", example="description_company"),
 *                     @OA\Property(property="vat_company", type="integer", example=123),
 *                     @OA\Property(property="zip_company", type="integer", example=123),
 *                     @OA\Property(property="name_manager", type="string", example="manager"),
 *                     @OA\Property(property="email_manager", type="string", example="manager@mail.ru"),
 *                     @OA\Property(property="phone_manager", type="string", example="+79559759123"),
 *                     @OA\Property(property="address_company", type="string", example="Lenina 10"),
 *                     @OA\Property(property="city_company", type="string", example="Moscow"),
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
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="title company example"),
 *                 @OA\Property(property="description", type="string", example="description_company"),
 *                 @OA\Property(property="vat", type="integer", example=123),
 *                 @OA\Property(property="zip", type="integer", example=123),
 *                 @OA\Property(property="name", type="string", example="manager"),
 *                 @OA\Property(property="email", type="string", example="manager@mail.ru"),
 *                 @OA\Property(property="phone", type="string", example="+79559759123"),
 *                 @OA\Property(property="address", type="string", example="Lenina 10"),
 *                 @OA\Property(property="city", type="string", example="Moscow"),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Delete(
 *     path="/api/clients/{client}",
 *     summary="Delete",
 *     tags={"Client"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Client's id",
 *         in="path",
 *         name="client",
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
class ClientController extends Controller
{

}
