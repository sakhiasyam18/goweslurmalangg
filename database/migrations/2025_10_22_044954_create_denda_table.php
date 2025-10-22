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
        Schema::create('denda', function (Blueprint $table) {
            $table->string('ID_Denda', 10)->primary();
            $table->string('ID_Pemesanan', 10);
            $table->dateTime('Tanggal_Denda_Dibuat');
            $table->decimal('Jumlah_Denda', 10, 2);
            $table->integer('Waktu_Selisih');

            $table->foreign('ID_Pemesanan')->references('ID_Pemesanan')->on('pemesanan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denda');
    }
};
