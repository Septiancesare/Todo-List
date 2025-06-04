<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create')->middleware('role:user');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store')->middleware('role:user');
    Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit')->middleware('role:user');
    Route::patch('/task/{task}', [TaskController::class, 'update'])->name('task.update')->middleware('role:user');
    Route::put('/task/{task}', [TaskController::class, 'update'])->name('task.update')->middleware('role:user');
    Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
    
    Route::get('/dashboard', [TaskController::class, 'index'])->name('task.index');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class); 
    });
});

require __DIR__ . '/auth.php';
