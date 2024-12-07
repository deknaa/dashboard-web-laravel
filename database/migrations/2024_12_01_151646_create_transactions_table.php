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
            $table->enum('jenis_transaksi', ['ruang_kelas', 'kendaraan']);
            $table->string('catatan')->nullable(); 
            $table->string('bukti_pembayaran')->nullable(); 
            $table->string('bukti_surat')->nullable(); 
            $table->dateTime('waktu_awal'); 
            $table->dateTime('waktu_akhir'); 
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruang_kelas_id')->nullable();
            $table->unsignedBigInteger('kendaraan_id')->nullable();
            $table->enum('status', ['dalam_proses', 'selesai', 'ditolak', 'disewa'])->default('dalam_proses');
            $table->integer('total_transaksi')->nullable();
            $table->text('alasan_tolak')->nullable();
            $table->timestamps();

            // Relasi ke tabel users dan ruang kelas dan kendaraan
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ruang_kelas_id')->references('id')->on('ruangkelas')->onDelete('cascade');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan')->onDelete('cascade');
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
