<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'name', 'nim', 'jeniskelamin',
        'ttl','alamat','angkatan', 'email'
    ];
}
