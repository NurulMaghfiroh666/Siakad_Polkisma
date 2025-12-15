<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    
    protected $table = 'nilais';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'krs_detail_id',
        'nilai_angka',
        'nilai_huruf'
    ];

    public function krsDetail()
    {
        return $this->belongsTo(KrsDetail::class, 'krs_detail_id', 'id');
    }

    /**
     * Konversi nilai angka ke nilai huruf
     * A: 85-100, B: 70-84, C: 60-69, D: 50-59, E: 0-49
     */
    public static function nilaiToHuruf($nilaiAngka)
    {
        if ($nilaiAngka >= 85) return 'A';
        if ($nilaiAngka >= 70) return 'B';
        if ($nilaiAngka >= 60) return 'C';
        if ($nilaiAngka >= 50) return 'D';
        return 'E';
    }

    /**
     * Konversi nilai huruf ke grade point
     * A=4, B=3, C=2, D=1, E=0
     */
    public static function hurufToGradePoint($nilaiHuruf)
    {
        $gradePoints = [
            'A' => 4.0,
            'B' => 3.0,
            'C' => 2.0,
            'D' => 1.0,
            'E' => 0.0
        ];
        
        return $gradePoints[$nilaiHuruf] ?? 0.0;
    }
}
