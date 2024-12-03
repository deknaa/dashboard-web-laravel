<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ruangkelas')->insert([
            'nama_ruangan' => "Kelas A1",
            'gambar' => "foto 1",
            'lokasi' => "Kampus Undiknas",
            'harga_sewa' => "1000",
            'status' => "active",
        ]);

        DB::table('ruangkelas')->insert([
            'nama_ruangan' => "Audoturium",
            'gambar' => "foto 2",
            'lokasi' => "1249341",
            'harga_sewa' => "15000",
            'status' => "active",
        ]);
    }
}
