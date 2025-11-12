<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'jenis',
    ];

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class, 'kategori_id');
    }
}
