<?php

use App\Http\Controllers\Api\V1\{
    UserController,
    ClientController,
    ProjectController,
    TaskController,
    ResponseController,
};
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

Route::group([
    'prefix'     => 'v1',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('user/deleted', [UserController::class, 'deleted'])->name('user.deleted');
    Route::post('user/{user}', [UserController::class, 'restore'])->name('user.restore');

    Route::get('client/deleted', [ClientController::class, 'deleted'])->name('client.deleted');
    Route::post('client/{user}', [ClientController::class, 'restore'])->name('client.restore');

    Route::get('project/deleted', [ProjectController::class, 'deleted'])->name('project.deleted');
    Route::post('project/{user}', [ProjectController::class, 'restore'])->name('project.restore');

    Route::post('task/add-response', [TaskController::class, 'addResponse'])->name('task.add-response');
    Route::get('task/deleted', [TaskController::class, 'deleted'])->name('task.deleted');
    Route::post('task/{user}', [TaskController::class, 'restore'])->name('task.restore');

    Route::apiResources([
        'user'    => UserController::class,
        'client'  => ClientController::class,
        'project' => ProjectController::class,
        'task'    => TaskController::class,
    ]);

    Route::apiResource('response', ResponseController::class)->only('destroy');
});
