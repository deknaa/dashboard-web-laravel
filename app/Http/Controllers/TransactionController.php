<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\RuangKelas;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // function untuk user melihat history transaksi keseluruhan
    public function historyTransactions()
    {
        // transaksi 
        $user = Auth::user();
        // $pendingTransaction = Transaction::where('user_id', $user->id)->where('status', 'dalam_proses')->count();
        $totalTransaction = Transaction::where('user_id', $user->id)
            ->whereNotNull('id')
            ->count();
        $transactionUser = Transaction::where('user_id', $user->id)
            ->whereNotNull('id')
            ->paginate(5);
        $totalAndPending = [$totalTransaction, $transactionUser->count()];

        return view('Transactions.users.show', compact('transactionUser', 'totalAndPending'));
    }

    // detail per transaksi
    public function show($id)
    {
        // Menampilkan detail transaksi berdasarkan ID
        $transaksi = Transaction::findOrFail($id);

        // Ambil semua transaksi dengan nama ruang kelas dan kendaraan
        $transactions = Transaction::with('ruangKelas', 'kendaraan')->paginate(5);

        foreach ($transactions as $item) {
            echo "Nama Ruang Kelas: " . optional($item->ruangKelas)->nama_ruangan;
            echo "Nama Kendaraan: " . optional($item->kendaraan)->nama_kendaraan;
        }
        return view('Transactions.users.details', compact('transactions', 'transaksi'));
    }

    // buat transaksi
    public function create()
    {
        // Hanya mengambil ruang kelas dengan status "active"
        $ruangKelas = RuangKelas::where('status', 'active')->get();

        // Hanya mengambil kendaraan dengan status "active"
        $kendaraan = Kendaraan::where('status', 'active')->get();

        return view('Transactions.users.create', compact('ruangKelas', 'kendaraan'));
    }

    // simpan hasil transaksi
    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi' => 'required|in:ruang_kelas,kendaraan',
            'waktu_awal' => 'required|date',
            'waktu_akhir' => 'required|date|after:waktu_awal',
            'bukti_pembayaran' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:3072',
            'bukti_surat' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:3072',
            'catatan' => 'nullable|string',
            'ruang_kelas_id' => 'required_if:jenis_transaksi,ruang_kelas|nullable|exists:ruangkelas,id',
            'kendaraan_id' => 'required_if:jenis_transaksi,kendaraan|nullable|exists:kendaraan,id',
        ]);

        $transactionData = [
            'user_id' => Auth::user()->id,
            'waktu_awal' => $request->waktu_awal,
            'waktu_akhir' => $request->waktu_akhir,
            'bukti_pembayaran' => $request->file('bukti_pembayaran') 
                                ? $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public') 
                                : null,
            'bukti_surat' => $request->file('bukti_surat')
                            ? $request->file('bukti_surat')->store('bukti_surat', 'public') 
                            : null,
            'catatan' => $request->catatan,
            'status' => 'dalam_proses',
        ];

        // Hitung durasi dalam jam
        $waktuAwal = Carbon::parse($request->waktu_awal);
        $waktuAkhir = Carbon::parse($request->waktu_akhir);
        $durasi = $waktuAwal->diffInDays($waktuAkhir);

        // Tentukan harga sewa berdasarkan jenis transaksi
        if ($request->jenis_transaksi === 'ruang_kelas') {
            $ruangKelas = RuangKelas::findOrFail($request->ruang_kelas_id);
            $transactionData['jenis_transaksi'] = 'ruang_kelas';
            $transactionData['ruang_kelas_id'] = $ruangKelas->id;
            $transactionData['kendaraan_id'] = null;
            $transactionData['total_transaksi'] = $durasi * $ruangKelas->harga_sewa; // Harga * durasi

            // Ubah status Ruang Kelas menjadi "disewa"
            $ruangKelas->update(['status' => 'disewa']);
        } elseif ($request->jenis_transaksi === 'kendaraan') {
            $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);
            $transactionData['jenis_transaksi'] = 'kendaraan';
            $transactionData['kendaraan_id'] = $kendaraan->id;
            $transactionData['ruang_kelas_id'] = null;
            $transactionData['total_transaksi'] = $durasi * $kendaraan->harga_sewa; // Harga * durasi

            // Ubah status Kendaraan menjadi "disewa"
            $kendaraan->update(['status' => 'disewa']);
        }

        $transactionData['status'] = 'dalam_proses';

        Transaction::create($transactionData);

        return redirect()->route('dashboard')->with('success', 'Transaksi baru anda berhasil dibuat.');
    }

    public function edit(Transaction $transaction)
    {
        $ruangKelas = RuangKelas::all();
        return view('transactions.edit', compact('transaction', 'ruangKelas'));
    }

    // Update transaksi
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'ruang_kelas_id' => 'required|exists:ruangkelas,id',
            'waktu_awal' => 'required|date',
            'waktu_akhir' => 'required|date|after:waktu_awal',
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $transaction->update([
            'ruang_kelas_id' => $request->ruang_kelas_id,
            'waktu_awal' => $request->waktu_awal,
            'waktu_akhir' => $request->waktu_akhir,
            'status' => $request->status,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    // Hapus transaksi
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function createByAdmin()
    {
        // Ambil user dengan role 'user'
        $users = User::where('role', 'user')->get();

        $ruangKelas = RuangKelas::where('status', 'active')->get(); // Ruang Kelas dengan status aktif
        $kendaraan = Kendaraan::where('status', 'active')->get(); // Kendaraan dengan status aktif


        return view('Transactions.admin.create', compact('users', 'ruangKelas', 'kendaraan'));
    }

    public function storeByAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_transaksi' => 'required|in:ruang_kelas,kendaraan',
            'waktu_awal' => 'required|date',
            'waktu_akhir' => 'required|date|after:waktu_awal',
            'bukti_pembayaran' => 'required|file|mimes:png,jpg,jpeg,pdf|max:3072',
            'ruang_kelas_id' => 'required_if:jenis_transaksi,ruang_kelas|nullable|exists:ruangkelas,id',
            'kendaraan_id' => 'required_if:jenis_transaksi,kendaraan|nullable|exists:kendaraan,id',
            'catatan' => 'nullable|string',
        ]);

        // Simpan file bukti pembayaran
        $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $transactionData = [
            'user_id' => $request->user_id,
            'jenis_transaksi' => $request->jenis_transaksi,
            'waktu_awal' => $request->waktu_awal,
            'waktu_akhir' => $request->waktu_akhir,
            'bukti_pembayaran' => $buktiPembayaranPath,
            'catatan' => $request->catatan,
            'status' => 'dalam_proses',
        ];

        // Menghitung durasi
        $waktuAwal = Carbon::parse($request->waktu_awal);
        $waktuAkhir = Carbon::parse($request->waktu_akhir);
        $durasi = $waktuAwal->diffInDays($waktuAkhir);

        // Proses berdasarkan jenis transaksi
        if ($request->jenis_transaksi === 'ruang_kelas') {
            $ruangKelas = RuangKelas::findOrFail($request->ruang_kelas_id);
            $transactionData['ruang_kelas_id'] = $ruangKelas->id;
            $transactionData['kendaraan_id'] = null;
            $transactionData['total_transaksi'] = $durasi * $ruangKelas->harga_sewa;

            // Update status ruang kelas
            $ruangKelas->update(['status' => 'disewa']);
        } elseif ($request->jenis_transaksi === 'kendaraan') {
            $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);
            $transactionData['kendaraan_id'] = $kendaraan->id;
            $transactionData['ruang_kelas_id'] = null;
            $transactionData['total_transaksi'] = $durasi * $kendaraan->harga_sewa;

            // Update status kendaraan
            $kendaraan->update(['status' => 'disewa']);
        }

        Transaction::create($transactionData);

        return redirect()->route('admin.transactions.create')->with('success', 'Transaksi berhasil dibuat untuk user.');
    }
}
