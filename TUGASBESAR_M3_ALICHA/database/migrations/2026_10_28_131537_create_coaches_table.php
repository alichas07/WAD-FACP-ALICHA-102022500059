<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('kode_coach')->unique();
            $table->string('nama_coach');
            $table->string('nomor_telephone_coach');
            $table->string('cabang_olahraga');
            $table->string('nomor_lisensi');
            $table->decimal('tarif_perjam', 10, 2);
            $table->enum('status_coach', ['Tersedia', 'Dalam Sesi', 'Sedang Cuti', 'Nonaktif'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};