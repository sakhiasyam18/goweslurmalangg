<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ini intinya buat ngisi colum colum table nya 
     */
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->string('ID_Pelanggan', 10)->primary();
            $table->string('Nama', 50);
            $table->string('Alamat', 100);
            $table->string('No_Telepon', 15);
            $table->string('Bukti_Pembayaran', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
