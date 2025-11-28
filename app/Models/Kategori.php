<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama_kategori', 'jenis'];

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'id_kategori');
    }
}
