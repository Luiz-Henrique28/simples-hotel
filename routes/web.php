<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', [TaskController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('tasks/trash', [TaskController::class, 'trash'])->name('tasks.trash');
    Route::patch('tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore')->withTrashed();

    Route::resource('tasks', TaskController::class); 
});

require __DIR__.'/auth.php';
