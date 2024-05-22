<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/blog/{id}', [BlogController::class, 'detail'])->name('blog');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::get('/home', function () {
    return redirect()->route('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Routes for display and create new blog
    Route::get('/dashboard', [DashboardController::class, 'create'])->name('dashboard');
    Route::post('/dashboard', [BlogController::class, 'store'])->name('dashboard.post');

    // Routes for updating and deleting blogs
    Route::get('/dashboard/{id}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{id}', [BlogController::class, 'update'])->name('dashboard.update');
    Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.delete');

    // Route for listing user's blogs
    Route::get('/dashboard/my-blogs', [DashboardController::class, 'index'])->name('dashboard.list');

});
