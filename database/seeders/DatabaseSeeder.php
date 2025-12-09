<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Admin/Dosen
        $dosen = \App\Models\Dosen::create([
            'Nama' => 'Dr Haris S.Kom M.Kom',
            'NIP' => '198501012010011001',
            'Email' => 'dosen@polkisma.ac.id',
            'NoTelpon' => '081234567890',
        ]);

        \App\Models\User::create([
            'Username' => 'dosen',
            'Password' => bcrypt('password'),
            'Role' => 'dosen',
            'IdDosen' => $dosen->IdDosen,
        ]);
        
        // Mahasiswa
        $mahasiswa = \App\Models\Mahasiswa::create([
            'Nama' => 'Muhammad Iqbal',
            'NIM' => '202301001',
            'Email' => 'mahasiswa@polkisma.ac.id',
            'NoTelpon' => '089876543210',
            'TahunMasuk' => '2023',
            'IdJurusan' => 1, // Assumption: Jurusan ID 1 exists
        ]);

        \App\Models\User::create([
            'Username' => 'mahasiswa',
            'Password' => bcrypt('password'),
            'Role' => 'mahasiswa',
            'IdMahasiswa' => $mahasiswa->IdMahasiswa,
        ]);
        
        // Matakuliah Dummy
        $mk1 = \App\Models\Matakuliah::create([
            'KodeMK' => 'TI101',
            'NamaMK' => 'Algoritma dan Pemrograman',
            'SKS' => 3,
            'IdJurusan' => 1,
        ]);
        
        $mk2 = \App\Models\Matakuliah::create([
            'KodeMK' => 'TI102',
            'NamaMK' => 'Basis Data',
            'SKS' => 3,
            'IdJurusan' => 1,
        ]);
        
        $mk3 = \App\Models\Matakuliah::create([
            'KodeMK' => 'TI103',
            'NamaMK' => 'Pemrograman Web',
            'SKS' => 3,
            'IdJurusan' => 1,
        ]);
        
        $mk4 = \App\Models\Matakuliah::create([
            'KodeMK' => 'TI104',
            'NamaMK' => 'Matematika Diskrit',
            'SKS' => 3,
            'IdJurusan' => 1,
        ]);
        
        // Jadwal for Dosen (matching current day for testing)
        $hariIni = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][date('w')];
        
        \App\Models\Jadwal::create([
            'IdJadwal' => 1,
            'IdDosen' => $dosen->IdDosen,
            'KodeMK' => $mk1->KodeMK,
            'Hari' => $hariIni,
            'Jam' => '07.00-09.00',
            'Kelas' => 'Informatika A - S1',
            'Ruang' => 'Ruang 7',
        ]);
        
        \App\Models\Jadwal::create([
            'IdJadwal' => 2,
            'IdDosen' => $dosen->IdDosen,
            'KodeMK' => $mk2->KodeMK,
            'Hari' => $hariIni,
            'Jam' => '13.00-15.00',
            'Kelas' => 'Informatika B - S1',
            'Ruang' => 'Ruang 7',
        ]);
        
        \App\Models\Jadwal::create([
            'IdJadwal' => 3,
            'IdDosen' => $dosen->IdDosen,
            'KodeMK' => $mk3->KodeMK,
            'Hari' => 'Selasa',
            'Jam' => '07.00-09.00',
            'Kelas' => 'Informatika A - S3',
            'Ruang' => 'Ruang 7',
        ]);
        
        \App\Models\Jadwal::create([
            'IdJadwal' => 4,
            'IdDosen' => $dosen->IdDosen,
            'KodeMK' => $mk4->KodeMK,
            'Hari' => 'Rabu',
            'Jam' => '07.00-09.00',
            'Kelas' => 'Informatika A - S2',
            'Ruang' => 'Ruang 7',
        ]);
    }
}
