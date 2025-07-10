<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    ProfileController,
    UserController,
    ClientController,
    ProjectController,
    TaskController,
};

Route::redirect('/', '/login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/tasks/deleted', [TaskController::class, 'getSoftDeletedTasks'])->name('tasks.deleted');
    Route::get('/tasks/deleted/{id}/restore', [TaskController::class, 'restoreSoftDeletedTasks'])->name('tasks.deleted.restore');
    Route::delete('/tasks/deleted/{id}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.deleted.force');
    Route::resources([
        '/users' => UserController::class,
        '/clients' => ClientController::class,
        '/projects' => ProjectController::class,
        '/tasks' => TaskController::class,
    ]);
    Route::singleton('/profile', ProfileController::class)->only('edit', 'update', 'destroy')->destroyable();
});

require __DIR__.'/auth.php';
