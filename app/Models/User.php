<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
        'password',
        'role'
    ];

    public function rental()
    {
        return $this->hasMany(Rental::class, 'id_user');
    }
}
