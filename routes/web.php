<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\NoteController;
use App\Models\Transaction;
use App\Models\Todo;
use App\Models\Note;
use App\Models\User;

// Dashboard (hanya untuk user login)
Route::get('/dashboard', function () {
    if (!session()->has('user')) {
        return redirect()->route('login');
    }

    $userId = session('user')->id;

    $todos = Todo::where('user_id', $userId)
        ->orderBy('id', 'desc')
        ->get();

    $note = Note::firstOrCreate(
        ['user_id' => $userId],
        ['content' => '']
    );

    // ✅ Fix PostgreSQL grouping issue
    $transactionData = Transaction::select(
        DB::raw("DATE(date) as date"),
        DB::raw("SUM(amount) as total")
    )
        ->where('user_id', $userId)
        ->groupBy(DB::raw("DATE(date)")) // ✅ gunakan ekspresi asli
        ->orderBy(DB::raw("DATE(date)"), 'asc')
        ->get();
    
    $income = Transaction::where('user_id', $userId)
        ->where('type', 'income')
        ->sum('amount');

    $expense = Transaction::where('user_id', $userId)
        ->where('type', 'expense')
        ->sum('amount');
    
    return view('dashboard', compact('todos', 'note', 'transactionData', 'income', 'expense'));
})->middleware('authcheck')->name('dashboard');


// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Transactions (CRUD) hanya bisa diakses user login
Route::middleware('authcheck')->group(function () {
    Route::resource('transactions', TransactionController::class);
});

// routes/web.php
Route::middleware('authcheck')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/balance', [ProfileController::class, 'updateBalance'])->name('profile.updateBalance');
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

Route::middleware(['authcheck'])->group(function () {
    Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
    Route::patch('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');
});

Route::middleware('authcheck')->group(function () {
    Route::get('/profile/note', [NoteController::class, 'edit'])->name('note.edit');
    Route::post('/profile/note', [NoteController::class, 'update'])->name('note.update');
});
