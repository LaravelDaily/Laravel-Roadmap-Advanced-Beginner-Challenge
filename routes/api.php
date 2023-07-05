<?php

use App\Http\Controllers\Api\{AuthController, ClientController, ProjectController, UsersController};
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

//Public Routes

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//Private Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('isAdminApi')->group(function () {
        Route::apiResource('user', UsersController::class);
        Route::apiResource('client', ClientController::class);
        Route::apiResource('project', ProjectController::class);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
