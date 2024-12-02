<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'jenis_transaksi',
        'catatan',
        'bukti_pembayaran',
        'waktu_awal',
        'waktu_akhir',
        'user_id',
    ];

    // relasi ke user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
