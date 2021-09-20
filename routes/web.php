<?php

use App\Http\Controllers\{
    DashboardController,
    UserController,
    ClientController,
    ProjectController,
    TaskController,
    ResponseController,
    MediaUploadContoller,
};
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Auth::routes([
    'register' => false,
    'verify'   => true,
]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group([
    'middleware' => ['auth', 'verified'],
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('user/deleted', [UserController::class, 'deleted'])->name('user.deleted');
    Route::post('user/{user}', [UserController::class, 'restore'])->name('user.restore');

    Route::get('client/deleted', [ClientController::class, 'deleted'])->name('client.deleted');
    Route::post('client/{user}', [ClientController::class, 'restore'])->name('client.restore');

    Route::post('project/{project}/remove-media/{id}', [ProjectController::class, 'removeMedia'])->name('project.remove-media');
    Route::get('project/deleted', [ProjectController::class, 'deleted'])->name('project.deleted');
    Route::post('project/{project}', [ProjectController::class, 'restore'])->name('project.restore');

    Route::post('task/add-response', [TaskController::class, 'addResponse'])->name('task.add-response');
    Route::post('task/{task}/remove-media/{id}', [TaskController::class, 'removeMedia'])->name('task.remove-media');
    Route::get('task/deleted', [TaskController::class, 'deleted'])->name('task.deleted');
    Route::post('task/{task}', [TaskController::class, 'restore'])->name('task.restore');

    Route::resources([
        'user'   => UserController::class,
        'client' => ClientController::class,
    ], ['except' => ['show']]);

    Route::resources([
        'project' => ProjectController::class,
        'task'    => TaskController::class,
    ]);

    Route::resource('response', ResponseController::class)->only('destroy');

    Route::post('media/upload', MediaUploadContoller::class)->name('media.upload');
});

Route::fallback(function () {
    if (Auth::guest()) {
        return response()->redirectTo(\route('login'));
    }

    return response()
        ->view('errors.404')
        ->setStatusCode(404);
});
