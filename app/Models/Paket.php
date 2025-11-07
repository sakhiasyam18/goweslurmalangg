<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel yang terhubung dengan model ini.
     */
    protected $table = 'paket';

    /**
     * Menentukan primary key tabel.
     */
    protected $primaryKey = 'ID_Paket';

    /**
     * Menentukan tipe data primary key.
     */
    protected $keyType = 'string';

    /**
     * Memberi tahu Laravel bahwa primary key BUKAN auto-incrementing integer.
     */
    public $incrementing = false;

    /**
     * Kolom yang boleh diisi (mass assignable).
     * (Sesuai dengan file migrasi 2025_10_22_044936_create_paket_table.php)
     */
    protected $fillable = [
        'ID_Paket',
        'Nama_Paket',
        'Durasi_Jam',
        'Kategori_Sepeda',
        'Harga'
    ];

    /**
     * Menonaktifkan timestamps (created_at dan updated_at)
     * karena tidak ada di tabel migrasi Anda.
     */
    public $timestamps = false;
}