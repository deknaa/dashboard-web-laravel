<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => "Admin",
            'email' => "admin@gmail.com",
            'nik' => "123456789",
            'no_telp' => "123456789",
            'status' => "active",
            'role' => "admin",
            'password' => Hash::make('Admin123'),
        ]);

        DB::table('users')->insert([
            'nama' => "Dekna",
            'email' => "dekna@gmail.com",
            'nik' => "1249341",
            'no_telp' => "1231231",
            'status' => "active",
            'role' => "user",
            'password' => Hash::make('Dekna123'),
        ]);
    }
}
