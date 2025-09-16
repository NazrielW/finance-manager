<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\GuestCheck;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('authcheck')->name('dashboard');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('authcheck')->group(function () {
Route::resource('transactions', TransactionController::class);
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guestcheck')
    ->name('login');
                                                                                                      
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->middleware('guestcheck')
    ->name('register');