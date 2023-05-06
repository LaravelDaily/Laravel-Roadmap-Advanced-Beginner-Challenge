<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Resources\projectResource;
use App\Models\Project;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('projects',\App\Http\Controllers\Api\ProjectController::class)
    ->middleware('auth:sanctum');

//Route::get('/projects/{id}',function ($id){
//    return  new projectResource(Project::find($id));
//})->middleware('auth:sanctum');

Route::get('/tokens/create/{id}',function ($id){
    $user=\App\Models\User::find($id);
     return $user->createToken($user->name)->plainTextToken;
});
