<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_transaksi', ['sewa_ruangan', 'pinjam_kendaraan']);
            $table->string('catatan')->nullable(); 
            $table->string('bukti_pembayaran'); 
            $table->dateTime('waktu_awal')->nullable(); 
            $table->dateTime('waktu_akhir')->nullable(); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relasi ke tabel user
            $table->enum('status', ['dalam_proses', 'selesai', 'ditolak'])->default('dalam_proses');
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
