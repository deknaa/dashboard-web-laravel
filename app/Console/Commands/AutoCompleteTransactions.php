<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoCompleteTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:autocomplete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Selesaikan transaksi yang melewati waktu akhir secara otomatis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $transactions = Transaction::where('status', 'dalam_proses')
            ->where('waktu_akhir', '<=', Carbon::now())
            ->get();

        foreach ($transactions as $transaksi) {
            if ($transaksi->jenis_transaksi === 'ruang_kelas' && $transaksi->ruangkelas) {
                $transaksi->ruangkelas->update(['status' => 'active']);
            } elseif ($transaksi->jenis_transaksi === 'kendaraan' && $transaksi->kendaraan) {
                $transaksi->kendaraan->update(['status' => 'active']);
            }

            $transaksi->status = 'selesai';
            $transaksi->save();
        }

        $this->info('Transaksi otomatis diselesaikan.');
    }
}
