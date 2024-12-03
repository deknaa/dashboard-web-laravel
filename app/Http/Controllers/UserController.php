<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $cardTittle = ['Transaksi Pending', 'Total Transaksi'];

        // transaksi 
        $user = Auth::user();
        $totalTransaction = Transaction::where('user_id', $user->id)->whereNotNull('id')->count();
        $transactionUser = Transaction::where('user_id', $user->id)->whereNotNull('id')->get();

        $totalAndPending = [$totalTransaction, $transactionUser->count()];

        // Ambil semua transaksi dengan nama ruang kelas dan kendaraan
        $transactions = Transaction::with('ruangKelas', 'kendaraan')->paginate(5);

        foreach ($transactions as $transaction) {
            echo "Nama Ruang Kelas: " . optional($transaction->ruangKelas)->nama_ruangan;
            echo "Nama Kendaraan: " . optional($transaction->kendaraan)->nama_kendaraan;
        }

        return view('users.index', compact('cardTittle', 'transactionUser', 'totalAndPending', 'transactions'));
    }
}
