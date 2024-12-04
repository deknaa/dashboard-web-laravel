<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $cardTittle = ['Transaksi Pending', 'Transaksi Selesai', 'Total Transaksi', 'Total User'];
        $transactionUser = Transaction::paginate(5);

        // Menghitung data yang dibutuhkan
        $jumlahPending = Transaction::where('status', 'dalam_proses')->count();
        $jumlahSelesai = Transaction::where('status', 'selesai')->count();
        $totalTransaksi = Transaction::whereIn('status', ['dalam_proses', 'selesai', 'ditolak'])->count();
        $totalUser = User::count();

        return view('admin.index', compact('cardTittle', 'jumlahPending', 'jumlahSelesai', 'totalTransaksi', 'totalUser', 'transactionUser'));
    }

    public function show($id)
    {
        // Menampilkan detail transaksi berdasarkan ID
        $transaksi = Transaction::findOrFail($id);

        // Ambil semua transaksi dengan nama ruang kelas dan kendaraan
        $transactions = Transaction::with('ruangKelas', 'kendaraan')->paginate(5);

        return view('Transactions.admin.show', compact('transaksi', 'transactions'));
    }

    public function process($id)
    {
        // Mengubah status transaksi menjadi selesai
        $transaksi = Transaction::findOrFail($id);
        $transaksi->status = 'selesai';
        $transaksi->alasan_tolak = null;
        $transaksi->save();

        return redirect()->route('dashboard.admin')->with('success', 'Transaksi berhasil diproses.');
    }

    public function reject(Request $request, $id)
    {
        // Menolak transaksi dan menyimpan alasan penolakan
        $request->validate([
            'alasan_tolak' => 'nullable|string',
        ]);

        $transaksi = Transaction::findOrFail($id);
        $transaksi->status = 'ditolak';
        $transaksi->alasan_tolak = $request->alasan_tolak;
        $transaksi->save();

        return redirect()->route('dashboard.admin')->with('success', 'Transaksi berhasil ditolak.');
    }

    public function userTransactions(){
        $transactionUser = Transaction::paginate(5);
        return view('Transactions.admin.userTransactions', compact('transactionUser'));
    }
}
