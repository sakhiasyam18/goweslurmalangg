<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pelanggan extends Model
{
    //
    use HasFactory;

    protected $table = 'pelanggan'; //nama table nya pelanggan
    protected $primaryKey = 'ID_Pelanggan'; //PK
    protected $keyType = 'string'; //type datanya
    public $incrementing = false; // tidak auto increament
    public $timestamps = false;

    //pengisian kolom nya
    protected $fillable = [
        'ID_Pelanggan',
        'Nama',
        'Alamat',
        'No_Telepon'
    ];

    // ini nanti buat id unik 
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                // Contoh ID: PEL-timestamp-randomstring
                $model->{$model->getKeyName()} = 'PEL-' . time() . '-' . Str::random(4);
            }
        });
    }
}
