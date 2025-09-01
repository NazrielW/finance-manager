<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('authCheck')->name('dashboard');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware('authCheck')->group(function () {
    Route::resource('transactions', TransactionController::class);
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');