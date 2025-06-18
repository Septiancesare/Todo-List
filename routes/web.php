<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
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

    Route::middleware('role:user')->group(function () {      
        Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
        Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
        Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
        Route::patch('/task/{task}', [TaskController::class, 'update'])->name('task.update');
        Route::put('/task/{task}', [TaskController::class, 'update'])->name('task.update');
    });
    Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
    
    Route::get('/dashboard', [TaskController::class, 'index'])->name('task.index');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class); 
    });
    

    Route::middleware('auth')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::patch('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
});
});

require __DIR__ . '/auth.php';
