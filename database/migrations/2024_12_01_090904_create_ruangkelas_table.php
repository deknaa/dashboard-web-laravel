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
        Schema::create('ruangkelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruangan');
            $table->string('gambar')->nullable();
            $table->string('lokasi');
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
        Schema::dropIfExists('ruangkelas');
    }
};
