<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('clients' , ClientController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class);
});

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
