<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_items', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('kategori_barang');
            $table->integer('total_stok')->default(0);
            $table->integer('stok_tersedia')->default(0);
            $table->string('kondisi')->default('Sangat Baik');
            $table->decimal('tarif_sewa', 10, 2);
            $table->decimal('denda_rusak', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_items');
    }
};