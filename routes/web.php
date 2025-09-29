<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;

// Dashboard (hanya untuk user login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('authcheck')->name('dashboard');

// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Transactions (CRUD) hanya bisa diakses user login
Route::middleware('authcheck')->group(function () {
    Route::resource('transactions', TransactionController::class);
});

// ========== AUTH ==========
// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->middleware('guestcheck')
    ->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guestcheck')
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
