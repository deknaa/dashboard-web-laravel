<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RuangKelas extends Model
{
    protected $table = 'ruangkelas';
    protected $fillable = [
        'nama_ruangan',
        'gambar',
        'lokasi',
        'harga_sewa',
        'status',
    ];

    public function transaction(){
        return $this->hasMany(Transaction::class, 'ruang_kelas_id');
    }
}
