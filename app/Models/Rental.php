<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'rental';
    protected $fillable = [
        'id_user',
        'id_kendaraan',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_harga',
        'status_sewa'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_rental');
    }

    public function detailPembayaran()
    {
        return $this->hasOne(DetailPembayaran::class, 'id_rental');
    }
}
