<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 🔥 Tambahkan ini!

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * masukan isi isi nya agar table nya tidak kosong
     */
    public function run(): void
    {
        //ini buat ngisi isi isi nya
        DB::table('paket')->insert([
            ['ID_Paket' => 'PK001', 'Nama_Paket' => 'Paket 1 Reguler', 'Durasi_Jam' => 24, 'Kategori_Sepeda' => 'Sepeda Reguler', 'Harga' => 110000.00],
            ['ID_Paket' => 'PK002', 'Nama_Paket' => 'Paket 2 Reguler', 'Durasi_Jam' => 168, 'Kategori_Sepeda' => 'Sepeda Reguler', 'Harga' => 350000.00],
            ['ID_Paket' => 'PK003', 'Nama_Paket' => 'Paket 3 Reguler', 'Durasi_Jam' => 720, 'Kategori_Sepeda' => 'Sepeda Reguler', 'Harga' => 750000.00],
            ['ID_Paket' => 'PR001', 'Nama_Paket' => 'Paket 1 Premium', 'Durasi_Jam' => 24, 'Kategori_Sepeda' => 'Sepeda Premium', 'Harga' => 275000.00],
            ['ID_Paket' => 'PR002', 'Nama_Paket' => 'Paket 2 Premium', 'Durasi_Jam' => 168, 'Kategori_Sepeda' => 'Sepeda Premium', 'Harga' => 1400000.00],
            ['ID_Paket' => 'PR003', 'Nama_Paket' => 'Paket 3 Premium', 'Durasi_Jam' => 720, 'Kategori_Sepeda' => 'Sepeda Premium', 'Harga' => 3750000.00],
        ]);
    }
}
