<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rate_cards', function (Blueprint $table) {
            $table->id('id_rate_card');
            $table->string('nama_layanan'); // Contoh: Instagram Post, TikTok Video
            $table->string('platform');      // Contoh: Instagram, TikTok, YouTube
            $table->text('deskripsi_layanan');
            $table->decimal('harga', 15, 2); // Menggunakan decimal untuk nilai uang
            $table->string('gambar_layanan')->nullable();
            $table->string('slug_layanan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rate_cards');
    }
};
