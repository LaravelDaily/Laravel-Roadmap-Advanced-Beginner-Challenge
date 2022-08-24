<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
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

Route::redirect('/', 'login');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth'])->name('dashboard');
Route::post('users/{id}/update/passowrd', [UserController::class , 'updatePassword'])->name('users.update.passowrd');
Route::resource('users', UserController::class)->middleware(['auth']);
Route::resource('clients', ClientController::class)->middleware(['auth']);
Route::resource('projects', ProjectController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
