<?php

use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'jwt.auth'], function () {
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class)->middleware('admin');
});
