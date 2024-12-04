<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
       // Judul kartu
        $cardTittle = ['Transaksi Pending', 'Total Transaksi'];

        // Total transaksi user (semua status)
        $totalTransaction = Transaction::where('user_id', $user->id)->count();

        // Transaksi pending
        $pendingTransaction = Transaction::where('user_id', $user->id)->where('status', 'dalam_proses')->count();

        // Transaksi user ditampilkan dalam bentuk tabel
        $transactionUser = Transaction::where('user_id', $user->id)->paginate(5);

        // Data transaksi (jika butuh detailnya di tempat lain)
        $transactions = Transaction::with('ruangKelas', 'kendaraan')->paginate(5);

        // Data yang akan ditampilkan dalam kartu
        $cardData = [$pendingTransaction, $totalTransaction];;

        // foreach ($transactions as $transaction) {
        //     echo "Nama Ruang Kelas: " . optional($transaction->ruangKelas)->nama_ruangan;
        //     echo "Nama Kendaraan: " . optional($transaction->kendaraan)->nama_kendaraan;
        // }

        return view('users.index', compact('cardTittle', 'cardData', 'transactionUser', 'transactions'));
    }
}
