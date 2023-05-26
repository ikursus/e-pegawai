<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserTrashController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ArticleTrashController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PhotoController;

// Route pelawat
Route::get('/', function () {
    return redirect('login');
});

// Route authentication
Route::get('login', fn() => view('auth.login'))->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Route selepas login
Route::middleware('auth')->group(function() {

    // Bahagian Dashboard
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // Bahagian Articles
    Route::resource('articles', ArticleController::class);

    Route::get('trash/articles', [ArticleTrashController::class, 'index'])->name('trash.articles.index');
    Route::patch('trash/articles/{id}', [ArticleTrashController::class, 'update'])->name('trash.articles.update');
    Route::delete('trash/articles/{id}', [ArticleTrashController::class, 'destroy'])->name('trash.articles.destroy');

    // Bahagian direktori Pengguna
    // Route::resource('users', UserController::class)->middleware('check.admin');

    Route::resource('users', UserController::class);

    // Route untuk access token API
    Route::get('tokens', [TokenController::class, 'index'])->name('tokens.index');
    Route::post('tokens', [TokenController::class, 'store'])->name('tokens.store');
    Route::delete('tokens/{id}', [TokenController::class, 'destroy'])->name('tokens.destroy');

    // Bahagian Logout
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // Route demo dapatkan photo dari API https://jsonplaceholder.typicode.com/
    Route::get('photos', [PhotoController::class, 'index'])->name('photos.index');

    // Chatting Route
    Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::post('chat/receive', [ChatController::class, 'receive'])->name('chat.receive');

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
