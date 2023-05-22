<?php

use App\Http\Controllers\Auth\LoginController;
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
    Route::get('dashboard', fn() => view('user.dashboard'));
});
