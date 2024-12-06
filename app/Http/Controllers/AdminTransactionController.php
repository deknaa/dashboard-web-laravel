<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\RuangKelas;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function create()
    {
        $users = User::where('role', 'user')->get(); // Ambil semua user
        $ruangKelas = RuangKelas::all(); // Ambil semua ruang kelas
        $kendaraan = Kendaraan::all(); // Ambil semua kendaraan

        return view('Transactions.admin.create', compact('users', 'ruangKelas', 'kendaraan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_transaksi' => 'required|in:ruang_kelas,kendaraan',
            'ruang_kelas_id' => 'nullable|exists:ruangkelas,id',
            'kendaraan_id' => 'nullable|exists:kendaraan,id',
            'waktu_awal' => 'required|date',
            'waktu_akhir' => 'required|date|after:waktu_awal',
            'total_transaksi' => 'required|numeric',
            'catatan' => 'nullable|string',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Simpan bukti pembayaran jika diunggah
        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        // Buat transaksi baru
        Transaction::create([
            'user_id' => $validated['user_id'],
            'jenis_transaksi' => $validated['jenis_transaksi'],
            'ruang_kelas_id' => $validated['ruang_kelas_id'] ?? null,
            'kendaraan_id' => $validated['kendaraan_id'] ?? null,
            'waktu_awal' => $validated['waktu_awal'],
            'waktu_akhir' => $validated['waktu_akhir'],
            'total_transaksi' => $validated['total_transaksi'],
            'catatan' => $validated['catatan'] ?? null,
            'bukti_pembayaran' => $validated['bukti_pembayaran'] ?? null,
            'status' => 'dalam_proses',
        ]);
    }
}
