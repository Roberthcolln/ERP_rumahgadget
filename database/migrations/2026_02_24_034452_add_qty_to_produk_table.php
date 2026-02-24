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
        Schema::table('produk', function (Blueprint $table) {
            // Menambahkan kolom qty setelah harga_jual_produk (atau kolom lain)
            // Default 0 agar tidak error pada data lama
            $table->integer('qty')->default(0)->after('harga_jual_produk');
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('qty');
        });
    }
};
