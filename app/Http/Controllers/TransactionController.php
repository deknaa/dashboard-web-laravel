<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        return view('Transactions.users.index');
    }

    public function historyTransactions()
    {
        // transaksi 
        $user = Auth::user();
        // $pendingTransaction = Transaction::where('user_id', $user->id)->where('status', 'dalam_proses')->count();
        $totalTransaction = Transaction::where('user_id', $user->id)->whereNotNull('id')->count();
        $transactionUser = Transaction::where('user_id', $user->id)->whereNotNull('id')->get();

        $totalAndPending = [$totalTransaction, $transactionUser->count()];
        return view('Transactions.users.show', compact('transactionUser', 'totalAndPending'));
    }
}
