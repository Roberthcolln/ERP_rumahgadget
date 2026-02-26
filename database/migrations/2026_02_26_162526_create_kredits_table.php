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
        Schema::create('kredit_produk', function (Blueprint $table) {
            // Gunakan incremental integer jika tabel lainnya juga menggunakan integer
            $table->increments('id_kredit');

            // SESUAIKAN: Menggunakan unsignedInteger (INT) bukan BigInt
            $table->unsignedInteger('id_kategori');
            $table->unsignedInteger('id_jenis');
            $table->unsignedInteger('id_tipe');
            $table->unsignedInteger('id_varian');
            $table->unsignedInteger('id_warna');

            // Field Keuangan
            $table->decimal('harga_kredit', 15, 2);
            $table->decimal('dp', 15, 2);
            $table->enum('cicilan', [6, 9, 12]);

            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis')->onDelete('cascade');
            $table->foreign('id_tipe')->references('id_tipe')->on('tipe')->onDelete('cascade');
            $table->foreign('id_varian')->references('id_varian')->on('varian')->onDelete('cascade');
            $table->foreign('id_warna')->references('id_warna')->on('warna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kredit_produk');
    }
};
