<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route untuk users (mahasiswa)
Route::middleware('auth', 'userRole', 'verified')->group(function () {
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/transactions/create', [TransactionController::class, 'index'])->name('transactions.create');
    Route::get('/dashboard/transactions/view', [TransactionController::class, 'historyTransactions'])->name('transactions.history');
});

// Route untuk users (admin)
Route::middleware('auth', 'adminRole')->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';