<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']); // cek profile user login
    Route::post('/logout', [AuthController::class, 'logout']); // logout
});

Route::get('/ping', function () {
    return response()->json(['message' => 'API is working!']);
});
