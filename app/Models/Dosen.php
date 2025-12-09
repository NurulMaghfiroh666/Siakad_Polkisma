<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'IdDosen';
    public $timestamps = false;
    
    protected $fillable = [
        'IdDosen',
        'Nama',
        'NIP',
        'Email',
        'NoTelpon'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'IdDosen', 'IdDosen');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
