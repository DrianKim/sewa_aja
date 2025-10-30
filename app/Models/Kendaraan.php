<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = [
        'kategori_id',
        'merk',
        'model',
        'tahun',
        'no_plat',
        'warna',
        'transmisi',
        'kapasitas_penumpang',
        'foto',
        'keterangan',
    ];
}
