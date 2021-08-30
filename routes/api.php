<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'return-json']], function (){
    Route::resource('users', UserController::class)->except([
        'create',
        'store',
        'edit'
    ]);
    Route::resource('clients', ClientController::class)->except([
        'create',
        'edit'
    ]);
    Route::resource('projects', ProjectController::class)->except([
        'create',
        'edit'
    ]);
    Route::resource('tasks', TaskController::class)->except([
        'create',
        'edit'
    ]);
    Route::post('/logout', [AuthController::class, 'logout']);
});
