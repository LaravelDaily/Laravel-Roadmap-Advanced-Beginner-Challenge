<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);

//write a resource route for projects table with php in laravel Ctrl+Shift+I
Route::middleware(['auth'])->group(function(){
    //admin
    Route::prefix('admin')->as('admin.')->middleware(['is_admin'])->group(function(){
        Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);
        Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
        Route::resource('tasks', \App\Http\Controllers\Admin\TaskController::class);
    });

    //user
    Route::prefix('user')->as('user.')->group(function(){
        Route::resource('clients', \App\Http\Controllers\User\ClientController::class);
        Route::resource('projects', \App\Http\Controllers\User\ProjectController::class);
        Route::resource('tasks', \App\Http\Controllers\User\TaskController::class);
    });
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
