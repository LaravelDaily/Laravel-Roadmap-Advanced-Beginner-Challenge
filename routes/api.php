<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    UserController,
    ClientController,
    ProjectController,
    TaskController,
};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', function (Request $request) {
    $request->validate([
        'email' => 'required|email|max:250',
        'password' => 'required|string|max:250',
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        $token = auth()->user()->createToken('ApiToken')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    return response()->json(['message' => 'Please check your Email or Password and try again to login.'], 401);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class)->except('store');
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class);
});

