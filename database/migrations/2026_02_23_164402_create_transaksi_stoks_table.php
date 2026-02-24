<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksi_stok', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('no_bukti')->unique(); // BM-001 atau BK-001
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->unsignedBigInteger('id_gudang');
            $table->unsignedBigInteger('id_user_petugas'); // Yang login (Penerima/Pemberi internal)
            $table->string('pihak_eksternal')->nullable(); // Nama Supplier atau Nama Pengambil
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_gudang')->references('id_gudang')->on('gudang');
            $table->foreign('id_user_petugas')->references('id')->on('users');
        });

        Schema::create('detail_transaksi_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->constrained('transaksi_stok', 'id_transaksi')->onDelete('cascade');
            $table->unsignedBigInteger('id_produk');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('id_produk')->references('id_produk')->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_stoks');
    }
};
