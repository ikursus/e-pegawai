<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

// Route pelawat
Route::get('/', function () {
    return redirect('login');
});

// Route authentication
Route::get('login', fn() => view('auth.login'))->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Route selepas login
Route::middleware('auth')->group(function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
});

// CRUD
// Route::get('/users', [UserController::class, 'index']);
// Route::get('/users/add', [UserController::class, 'create']);
// Route::post('/users/add', [UserController::class, 'store']);
// Route::post('/users/{id}', [UserController::class, 'show']);
// Route::get('/users/{id}/edit', [UserController::class, 'edit']);
// Route::patch('/users/{id}/edit', [UserController::class, 'update']);
// Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Route::resource('users', UserController::class)->only(['create', 'store', 'show']);
Route::resource('users', UserController::class);
