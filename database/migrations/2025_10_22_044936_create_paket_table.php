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
        Schema::create('paket', function (Blueprint $table) {
            $table->string('ID_Paket', 10)->primary();
            $table->string('Nama_Paket', 50);
            $table->integer('Durasi_Jam');
            $table->string('Kategori_Sepeda', 50);
            $table->decimal('Harga', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
