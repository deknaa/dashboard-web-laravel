<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'jenis_transaksi',
        'catatan',
        'bukti_pembayaran',
        'bukti_surat',
        'waktu_awal',
        'waktu_akhir',
        'user_id',
        'ruang_kelas_id',
        'kendaraan_id',
        'status',
        'total_transaksi',
        'alasan_tolak',
    ];

    // relasi dengan user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Ruang Kelas
    public function ruangKelas()
    {
        return $this->belongsTo(RuangKelas::class, 'ruang_kelas_id');
    }

    // Relasi dengan Kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}
