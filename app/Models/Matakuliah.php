<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'IdMataKuliah';
    public $timestamps = false;
    
    protected $fillable = [
        'IdMataKuliah',
        'KodeMK',
        'NamaMK',
        'SKS',
        'IdJurusan'
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
