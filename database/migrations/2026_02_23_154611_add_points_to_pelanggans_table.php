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
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->integer('point')->default(0);
            $table->enum('level', ['Bronze', 'Silver', 'Platinum'])->default('Bronze');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            //
        });
    }
};
