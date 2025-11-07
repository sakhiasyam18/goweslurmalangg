<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'ID_Pemesanan';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ID_Pemesanan',
        'ID_Pelanggan',
        'ID_Sepeda',
        'ID_Paket',
        'Tanggal_Mulai', // <-- Ganti dari Tanggal_Sewa
        'Tanggal_Selesai' // <-- Tambahkan ini
        // Hapus 'Durasi_Sewa', 'Total_Biaya', 'Status_Pemesanan'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                // ID contoh: ORD-timestamp-XYZ
                // Ini menghasilkan 17 karakter (ORD- + 10 digit + - + 3 random)
                $model->{$model->getKeyName()} = 'ORD-' . time() . '-' . Str::random(3);
            }
        });
    }

    // Relasi ke Denda (One to One)
    public function denda()
    {
        return $this->hasOne(Denda::class, 'ID_Pemesanan', 'ID_Pemesanan');
    }
}