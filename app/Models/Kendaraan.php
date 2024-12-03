<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $fillable = [
        'nama_kendaraan',
        'gambar',
        'no_polisi',
        'tahun_kendaraan',
        'harga_sewa',
        'status',
    ];

    public function transaction(){
        return $this->hasMany(Transaction::class, 'kendaraan_id');
    }
}
