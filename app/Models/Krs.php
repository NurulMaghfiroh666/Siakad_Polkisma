<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'IdMahasiswa', 'IdMahasiswa');
    }

    public function details()
    {
        return $this->hasMany(KrsDetail::class);
    }
}
