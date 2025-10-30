<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{

    protected $table = 'detail';

    protected $fillable = [
        'kendaraan_id',
        'harga_per_hari',
        'status',
    ];
}
