<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KrsDetail extends Model
{
    use HasFactory;
    
    protected $table = 'krs_details';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'krs_id',
        'jadwal_id'
    ];

    public function krs()
    {
        return $this->belongsTo(Krs::class, 'krs_id', 'id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'IdJadwal');
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'krs_detail_id', 'id');
    }

    /**
     * Get matakuliah through jadwal relationship
     */
    public function getMatakuliahAttribute()
    {
        return $this->jadwal ? $this->jadwal->matakuliah : null;
    }
}
