<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $guarded = ['id'];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
