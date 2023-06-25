<?php

use App\Http\Controllers\Crm\Client\ClientController;
use App\Http\Controllers\Crm\HomeController;
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

Route::group(['namespace' => 'App\Http\Controllers\Crm', 'prefix' => 'crm'], function() {
    Route::get('/', HomeController::class)->name('main.index');
});

Route::group(['namespace' => 'App\Http\Controllers\Crm\Client', 'prefix' => 'crm'], function() {
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
});


Auth::routes();

