<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\RuangKelas;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
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

    public function create()
    {
        $ruangKelas = RuangKelas::all();
        $kendaraan = Kendaraan::all();

        return view('Transactions.users.create', compact('ruangKelas', 'kendaraan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi' => 'required|in:ruang_kelas,kendaraan',
            'waktu_awal' => 'required|date',
            'waktu_akhir' => 'required|date|after:waktu_awal',
            'bukti_pembayaran' => 'required|file|mimes:png,jpg,jpeg,pdf|max:3072',
            'catatan' => 'nullable|string',
        ]);
    
        $transactionData = [
            'user_id' => Auth::user()->id,
            'waktu_awal' => $request->waktu_awal,
            'waktu_akhir' => $request->waktu_akhir,
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public'),
            'catatan' => $request->catatan,
        ];
    
        if ($request->jenis_transaksi === 'ruang_kelas') {
            $transactionData['jenis_transaksi'] = 'ruang_kelas';
            $transactionData['ruang_kelas_id'] = $request->ruang_kelas_id; 
            $transactionData['kendaraan_id'] = null;
        } elseif ($request->jenis_transaksi === 'kendaraan') {
            $transactionData['jenis_transaksi'] = 'kendaraan';
            $transactionData['kendaraan_id'] = $request->kendaraan_id;
            $transactionData['ruang_kelas_id'] = null;
        }
    
        $transactionData['status'] = 'dalam_proses';
    
        Transaction::create($transactionData);
    
        return redirect()->route('transactions.create')->with('success', 'Transaksi berhasil dibuat.');
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
}