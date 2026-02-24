<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            // Menambahkan kolom yang diminta
            $table->text('alamat')->nullable()->after('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('alamat');
            $table->date('tanggal_lahir')->nullable()->after('jenis_kelamin');
            $table->unsignedBigInteger('id_provinsi')->nullable()->after('tanggal_lahir');
            $table->unsignedBigInteger('id_kota')->nullable()->after('id_provinsi');
            $table->unsignedBigInteger('id_kecamatan')->nullable()->after('id_kota');
            $table->unsignedBigInteger('id_kelurahan')->nullable()->after('id_kecamatan');
            $table->string('status')->default('Pending')->after('id_kelurahan');
        });
    }

    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->dropColumn([
                'alamat',
                'jenis_kelamin',
                'tanggal_lahir',
                'id_provinsi',
                'id_kota',
                'id_kecamatan',
                'id_kelurahan',
                'status'
            ]);
        });
    }
};
