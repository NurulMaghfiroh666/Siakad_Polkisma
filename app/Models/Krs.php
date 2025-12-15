<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;
    
    protected $table = 'krs';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'IdMahasiswa',
        'semester'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'IdMahasiswa', 'IdMahasiswa');
    }

    public function details()
    {
        return $this->hasMany(KrsDetail::class, 'krs_id', 'id');
    }

    /**
     * Hitung total SKS dari KRS ini
     */
    public function getTotalSksAttribute()
    {
        return $this->details->sum(function ($detail) {
            return $detail->jadwal->matakuliah->SKS ?? 0;
        });
    }

    /**
     * Hitung IP Semester
     */
    public function getIpSemesterAttribute()
    {
        $totalBobot = 0;
        $totalSks = 0;

        foreach ($this->details as $detail) {
            if ($detail->nilai && $detail->jadwal && $detail->jadwal->matakuliah) {
                $sks = $detail->jadwal->matakuliah->SKS;
                $gradePoint = Nilai::hurufToGradePoint($detail->nilai->nilai_huruf);
                
                $totalBobot += $sks * $gradePoint;
                $totalSks += $sks;
            }
        }

        return $totalSks > 0 ? round($totalBobot / $totalSks, 2) : 0;
    }
}
