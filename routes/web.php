<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Kendaraan;
use App\Models\RuangKelas;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route untuk users (mahasiswa)
Route::middleware('auth', 'userRole', 'verified')->group(function () {
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/transactions/history', [TransactionController::class, 'historyTransactions'])->name('transactions.history');
    Route::get('/dashboard/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.details');
    Route::resource('transactions', TransactionController::class);
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