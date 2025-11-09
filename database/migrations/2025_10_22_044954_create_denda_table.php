<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('denda', function (Blueprint $table) {
            $table->string('ID_Denda', 25)->primary();
            $table->string('ID_Pemesanan', 25);
            $table->dateTime('Tanggal_Denda_Dibuat');
            $table->decimal('Jumlah_Denda', 12, 2);

            // kolom selisih yang konsisten dengan controller
            $table->integer('Jam_Selisih')->nullable();
            $table->string('Keterangan_Selisih', 100)->nullable();

            $table->foreign('ID_Pemesanan')
                ->references('ID_Pemesanan')->on('pemesanan')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('denda');
    }
};