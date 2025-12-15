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

    /**
     * Hitung IPK (Indeks Prestasi Kumulatif)
     */
    public function getIpkAttribute()
    {
        $allKrs = $this->krs;
        
        if ($allKrs->isEmpty()) {
            return 0;
        }

        $totalBobot = 0;
        $totalSks = 0;

        foreach ($allKrs as $krs) {
            foreach ($krs->details as $detail) {
                if ($detail->nilai && $detail->jadwal && $detail->jadwal->matakuliah) {
                    $sks = $detail->jadwal->matakuliah->SKS;
                    $gradePoint = \App\Models\Nilai::hurufToGradePoint($detail->nilai->nilai_huruf);
                    
                    $totalBobot += $sks * $gradePoint;
                    $totalSks += $sks;
                }
            }
        }

        return $totalSks > 0 ? round($totalBobot / $totalSks, 2) : 0;
    }
}
