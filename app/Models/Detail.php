<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{

    protected $table = 'detail';

    protected $fillable = [
        'kendaraan_id',
        'harga_per_hari',
        'harga_per_minggu',
        'harga_per_bulan',
        'harga_per_tahun',
        'status',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}
