<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'IdJadwal';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'KodeMK', 'KodeMK');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'IdDosen', 'IdDosen');
    }

    public function krsDetails()
    {
        return $this->hasMany(KrsDetail::class, 'jadwal_id', 'IdJadwal');
    }
}
