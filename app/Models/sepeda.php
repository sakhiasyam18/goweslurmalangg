<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepeda extends Model
{
    use HasFactory;

    protected $table = 'sepeda';
    protected $primaryKey = 'ID_Sepeda';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Sepeda',
        'Nama_Sepeda',
        'Kategori_Sepeda',
        'Status_Sepeda',
        'Gambar_Sepeda',
    ];

    public $timestamps = false;
}
