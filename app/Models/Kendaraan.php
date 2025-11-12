<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = [
        'kategori_id',
        'nama',
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

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detail()
    {
        return $this->hasOne(Detail::class, 'kendaraan_id');
    }

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return null;
    }
}
