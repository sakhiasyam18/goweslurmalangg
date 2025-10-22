<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 🔥 Tambahkan ini!


class SepedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ini buat ngisi isi isinya sepeda
        DB::table('sepeda')->insert([
            ['ID_Sepeda' => 'SP001', 'Nama_Sepeda' => 'Strattos S2', 'Kategori_Sepeda' => 'Sepeda Premium', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SP002', 'Nama_Sepeda' => 'Strattos S3', 'Kategori_Sepeda' => 'Sepeda Premium', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SR001', 'Nama_Sepeda' => 'Exotic', 'Kategori_Sepeda' => 'Sepeda Reguler', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SR002', 'Nama_Sepeda' => 'Evergreen', 'Kategori_Sepeda' => 'Sepeda Reguler', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SR003', 'Nama_Sepeda' => 'Jieyang', 'Kategori_Sepeda' => 'Sepeda Reguler', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SR004', 'Nama_Sepeda' => 'Polygon Lovina', 'Kategori_Sepeda' => 'Sepeda Reguler', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SR005', 'Nama_Sepeda' => 'Rugen', 'Kategori_Sepeda' => 'Sepeda Reguler', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SR006', 'Nama_Sepeda' => 'Sepeda Lipat', 'Kategori_Sepeda' => 'Sepeda Reguler', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SR007', 'Nama_Sepeda' => 'Monarch MJR', 'Kategori_Sepeda' => 'Sepeda Reguler', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SR008', 'Nama_Sepeda' => 'Rubick', 'Kategori_Sepeda' => 'Sepeda Reguler', 'Status_Sepeda' => 'Tersedia'],
            ['ID_Sepeda' => 'SR009', 'Nama_Sepeda' => 'Veloce 6.0', 'Kategori_Sepeda' => 'Sepeda Reguler', 'Status_Sepeda' => 'Tersedia'],
        ]);
    }
}
