<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangKelasController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDataController;
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
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/dashboard/users-transactions/history', [AdminController::class, 'userTransactions'])->name('dashboard.admin.transactions');
    Route::resource('transaction', AdminController::class);
    Route::post('transaction/{id}/proses', [AdminController::class, 'process'])->name('admin.transaction.process');
    Route::post('transaction/{id}/tolak', [AdminController::class, 'reject'])->name('admin.transaction.reject');
    Route::patch('/transactions/{id}/finish', [AdminController::class, 'finish'])->name('admin.transaction.finish');


    // CRUD untuk Ruang Kelas
    Route::resource('ruangkelas', RuangKelasController::class);
    // CRUD untuk Kendaraan
    Route::resource('kendaraan', KendaraanController::class);
    // CRUD untuk User
    Route::resource('users', UserDataController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';