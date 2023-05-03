<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\AuthenticationController;
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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/clients', ClientController::class)->names([
        'index' => 'api.clients.index',
        'store' => 'api.clients.store',
        'show' => 'api.clients.show',
        'update' => 'api.clients.update',
        'destroy' => 'api.clients.destroy'
    ]);
    
    Route::apiResource('/projects', ProjectController::class)->names([
        'index' => 'api.projects.index',
        'store' => 'api.projects.store',
        'show' => 'api.projects.show',
        'update' => 'api.projects.update',
        'destroy' => 'api.projects.destroy'
    ]);
    
    Route::apiResource('/tasks', TaskController::class)->names([
        'index' => 'api.tasks.index',
        'store' => 'api.tasks.store',
        'show' => 'api.tasks.show',
        'update' => 'api.tasks.update',
        'destroy' => 'api.tasks.destroy'
    ]);
});
