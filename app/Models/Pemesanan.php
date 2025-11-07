<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Pastikan class-model terkait ada dan namespace benar
use App\Models\Pelanggan;
use App\Models\Sepeda;
use App\Models\Paket;
use App\Models\Denda;

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
        'Tanggal_Mulai',
        'Tanggal_Selesai'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = 'ORD-' . time() . '-' . Str::random(3);
            }
        });
    }

    // Relasi ke Pelanggan (many pemesanan belong to one pelanggan)
    public function pelanggan()
    {
        // belongsTo(RelatedModel::class, foreign_key_on_this_table, owner_key_on_related_table)
        return $this->belongsTo(Pelanggan::class, 'ID_Pelanggan', 'ID_Pelanggan');
    }

    // Relasi ke Sepeda
    public function sepeda()
    {
        return $this->belongsTo(Sepeda::class, 'ID_Sepeda', 'ID_Sepeda');
    }

    // Relasi ke Paket
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'ID_Paket', 'ID_Paket');
    }

    // Relasi ke Denda (One to One)
    public function denda()
    {
        return $this->hasOne(Denda::class, 'ID_Pemesanan', 'ID_Pemesanan');
    }
}