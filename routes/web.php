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
    return view('welcome');
});

Auth::routes();



Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 
    Route::resources([
        'users' => App\Http\Controllers\HomeController::class,
        'clients' => App\Http\Controllers\HomeController::class,
        'projects' => App\Http\Controllers\HomeController::class,
        'tasks' => App\Http\Controllers\HomeController::class,
    ]); 
});