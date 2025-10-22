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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->string('ID_Pemesanan', 10)->primary();
            $table->string('ID_Pelanggan', 10);
            $table->string('ID_Paket', 10);
            $table->string('ID_Sepeda', 10);
            $table->dateTime('Tanggal_Mulai');
            $table->dateTime('Tanggal_Selesai');

            $table->foreign('ID_Pelanggan')->references('ID_Pelanggan')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_Paket')->references('ID_Paket')->on('paket')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_Sepeda')->references('ID_Sepeda')->on('sepeda')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
