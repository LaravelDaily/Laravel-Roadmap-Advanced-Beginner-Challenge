<?php

use App\Http\Controllers\Crm\Client\ClientController;
use App\Http\Controllers\Crm\HomeController;
use App\Http\Controllers\Crm\Project\ProjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Crm', 'prefix' => 'crm'], function () {
    Route::get('/', HomeController::class)->name('crm.main.index');
});

Route::group(['prefix' => 'crm'], function () {
    Route::resource('clients', ClientController::class, [
        'names' => [
            'index' => 'crm.client.index',
            'show' => 'crm.client.show',
            'create' => 'crm.client.create',
            'store' => 'crm.client.store',
            'edit' => 'crm.client.edit',
            'update' => 'crm.client.update',
            'destroy' => 'crm.client.destroy',
        ]
    ]);

    Route::resource('projects', ProjectController::class, [
        'names' => [
            'index' => 'crm.project.index',
            'show' => 'crm.project.show',
            'create' => 'crm.project.create',
            'store' => 'crm.project.store',
            'edit' => 'crm.project.edit',
            'update' => 'crm.project.update',
            'destroy' => 'crm.project.destroy',
        ]
    ]);

});


Auth::routes();

