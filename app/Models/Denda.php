<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Denda extends Model
{
    use HasFactory;

    protected $table = 'denda';
    protected $primaryKey = 'ID_Denda';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ID_Denda',
        'ID_Pemesanan',
        'Tanggal_Denda_Dibuat',
        'Jumlah_Denda',
        'Waktu_Selisih', // Disimpan dalam string, misal "2 Jam"
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = 'DND-' . time() . '-' . Str::upper(Str::random(3));
            }
        });
    }

    // Relasi kebalikannya
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'ID_Pemesanan', 'ID_Pemesanan');
    }
}