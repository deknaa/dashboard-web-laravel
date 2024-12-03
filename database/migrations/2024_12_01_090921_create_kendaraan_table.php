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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kendaraan');
            $table->enum('jenis_kendaraan', ['mobil', 'motor']);
            $table->string('gambar')->nullablew();
            $table->string('no_polisi')->unique();
            $table->year('tahun_kendaraan');
            $table->decimal('harga_sewa', 10, 2);
            $table->enum('status', ['active', 'not_active', 'disewa'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
