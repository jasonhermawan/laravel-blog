<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

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
});
