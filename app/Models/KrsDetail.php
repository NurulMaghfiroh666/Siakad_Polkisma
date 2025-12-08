<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KrsDetail extends Model
{
    protected $guarded = ['id'];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
}
