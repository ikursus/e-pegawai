<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Route pelawat
Route::get('/', function () {
    return redirect('login');
});

// Route authentication
Route::get('login', fn() => view('auth.login'))->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Route selepas login
Route::middleware('auth')->group(function() {

    // Bahagian User
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::resource('articles', ArticleController::class);

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');


    // Bahagian pengurusan / admin
    Route::resource('users', UserController::class)->middleware('check.admin');


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


Route::get('run-job', function () {
    Artisan::call('queue:work', ['--stop-when-empty' => true]);
    return nl2br(Artisan::output());
});
