<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kendaraan')->insert([
            'nama_kendaraan' => "Toyota",
            'jenis_kendaraan' => "mobil",
            'gambar' => "foto 1",
            'no_polisi' => "DK 1 UD",
            'tahun_kendaraan' => "1998",
            'harga_sewa' => "1000",
            'status' => "active",
        ]);

        DB::table('kendaraan')->insert([
            'nama_kendaraan' => "Kijang",
            'jenis_kendaraan' => "mobil",
            'gambar' => "foto 2",
            'no_polisi' => "DK 1123 UD",
            'tahun_kendaraan' => "2017",
            'harga_sewa' => "1500",
            'status' => "active",
        ]);
    }
}
