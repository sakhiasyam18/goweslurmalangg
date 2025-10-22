<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *  ini intinya buat ngisi colum colum table nya 
     */
    public function up(): void
    {
        Schema::create('sepeda', function (Blueprint $table) {
            $table->string('ID_Sepeda', 10)->primary();
            $table->string('Nama_Sepeda', 50);
            $table->string('Kategori_Sepeda', 20);
            $table->enum('Status_Sepeda', ['Tersedia', 'Dipinjam']);
            $table->string('Gambar_Sepeda')->nullable(); // <-- Tambahkan ini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepeda');
    }
};