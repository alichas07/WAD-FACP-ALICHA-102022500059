<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('kode_lapangan')->unique();
            $table->string('nama_lapangan');
            $table->string('tipe_olahraga');
            $table->string('jenis_lantai');
            $table->string('ukuran_lapangan');
            $table->enum('status_lapangan', ['Tersedia', 'Maintenance', 'Renovasi', 'Dipesan'])->default('Tersedia');
            $table->decimal('tarif_perjam', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};