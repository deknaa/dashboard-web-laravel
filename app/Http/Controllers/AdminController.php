<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\RuangKelas;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $transaksi = Transaction::findOrFail($id);

        if ($transaksi->jenis_transaksi === 'ruang_kelas' && $transaksi->ruangkelas) {
            $transaksi->ruangkelas->update(['status' => 'disewa']);
        } elseif ($transaksi->jenis_transaksi === 'kendaraan' && $transaksi->kendaraan) {
            $transaksi->kendaraan->update(['status' => 'disewa']);
        }
    
        $transaksi->status = 'disewa';
        $transaksi->alasan_tolak = null;
        $transaksi->save();

        return redirect()->route('dashboard.admin.transactions')->with('success', "Transaksi Pengguna dengan nama {$transaksi->user->nama} berhasil diproses.");
    }

    public function reject(Request $request, $id)
    {
        // Menolak transaksi dan menyimpan alasan penolakan
        $request->validate(['alasan_tolak' => 'nullable|string']);

        $transaksi = Transaction::findOrFail($id);

        if ($transaksi->jenis_transaksi === 'ruang_kelas' && $transaksi->ruangkelas) {
            $transaksi->ruangkelas->update(['status' => 'active']);
        } elseif ($transaksi->jenis_transaksi === 'kendaraan' && $transaksi->kendaraan) {
            $transaksi->kendaraan->update(['status' => 'active']);
        }

        $transaksi->status = 'ditolak';
        $transaksi->alasan_tolak = $request->alasan_tolak;
        $transaksi->save();

        return redirect()->route('dashboard.admin.transactions')->with('success', "Transaksi Pengguna dengan nama {$transaksi->user->nama} berhasil ditolak.");
    }

    public function userTransactions(){
        $transactionUser = Transaction::paginate(5);
        return view('Transactions.admin.userTransactions', compact('transactionUser'));
    }

    public function finish($id)
{
    $transaction = Transaction::findOrFail($id);

    // Pastikan status saat ini adalah 'disewa'
    if ($transaction->status !== 'disewa') {
        return redirect()->back()->with('error', 'Hanya transaksi dengan status "disewa" yang dapat diselesaikan.');
    }

    DB::transaction(function () use ($transaction) {
        // Update status transaksi
        $transaction->status = 'selesai';
        $transaction->save();

        // Ubah status ruang kelas atau kendaraan ke 'active'
        if ($transaction->jenis_transaksi === 'ruang_kelas' && $transaction->ruang_kelas_id) {
            $ruangKelas = RuangKelas::find($transaction->ruang_kelas_id);
            $ruangKelas->status = 'active';
            $ruangKelas->save();
        } elseif ($transaction->jenis_transaksi === 'kendaraan' && $transaction->kendaraan_id) {
            $kendaraan = Kendaraan::find($transaction->kendaraan_id);
            $kendaraan->status = 'active';
            $kendaraan->save();
        }
    });

    return redirect()->route('dashboard.admin.transactions', $transaction->id)
                     ->with('success', 'Transaksi berhasil diselesaikan.');
}
}
