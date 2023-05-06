<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProjectController;
use \App\Http\Controllers\clientController;
use App\Http\Controllers\Auth\LoginController;

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

Auth::routes(['verify'=>true] );

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('projects',ProjectController::class)->middleware('auth');
Route::get('/projects/create',[ProjectController::class,'create']);

Route::post('projects/store',[ProjectController::class,'store']);
Route::post('projects/edit/{project}',[ProjectController::class,'edit']);
Route::post('projects/update/{project}',[ProjectController::class,'update']);
Route::get('projects/{project}',[ProjectController::class,'details']);
Route::delete('/projects/{project}/delete',[ProjectController::class,'destroy']);
Route::resource('clients',clientController::class)->middleware('auth');
Route::get('/clients/create',[clientController::class,'create']);

Route::post('clients/store',[clientController::class,'store']);
Route::post('clients/edit/{client}',[clientController::class,'edit']);
Route::post('clients/update/{client}',[clientController::class,'update']);
Route::delete('/clients/{client}/delete',[clientController::class,'destroy']);

//sending Mail
Route::get('/subscribe/{user_mail}',function ($user_mail){
    \Illuminate\Support\Facades\Mail::to($user_mail)->send(new \App\Mail\WelcomeMail());
    return redirect()->back();
});
//use scopes
Route::get('/done',[ProjectController::class,'done']);

Route::post('/project/tasks/create/{project_id}',[ProjectController::class,'addtask']);


Route::resource('tasks',\App\Http\Controllers\taskController::class)->middleware('auth');
//add user profile --to use spatie media library
Route::get('/profile/{id}',[\App\Http\Controllers\profileController::class,'show']);
Route::get('/editprofile/{user}',[\App\Http\Controllers\profileController::class,'editprofileimage']);
Route::post('/updateprofile/{user}',[\App\Http\Controllers\profileController::class,'store']);

//redirect
Route::redirect('/home','/login');
