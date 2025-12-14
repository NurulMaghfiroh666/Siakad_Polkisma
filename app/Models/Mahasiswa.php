<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'IdMahasiswa';
    public $timestamps = false;

    protected $fillable = [
        'IdMahasiswa',
        'NIM',
        'Nama',
        'Email',
        'NoTelpon',
        'TahunMasuk',
        'IdJurusan'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'IdMahasiswa', 'IdMahasiswa');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'IdMahasiswa', 'IdMahasiswa');
    }
}
