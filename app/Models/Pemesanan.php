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
        'ID_Paket', // Jika ada
        'Tanggal_Sewa',
        'Durasi_Sewa',
        'Total_Biaya',
        'Status_Pemesanan'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                // ID contoh: ORDER-timestamp
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