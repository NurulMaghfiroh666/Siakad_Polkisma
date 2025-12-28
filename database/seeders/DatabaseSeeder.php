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
        // Admin
        $this->call(AdminSeeder::class);
        
        // Dosen
        $dosen = \App\Models\Dosen::create([
            'Nama' => 'Dr. Haris S.Kom M.Kom',
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
        $mahasiswa1 = \App\Models\Mahasiswa::create([
            'Nama' => 'Muhammad Iqbal',
            'NIM' => '202301001',
            'Email' => 'mahasiswa@polkisma.ac.id',
            'NoTelpon' => '089876543210',
            'TahunMasuk' => '2023',
            'IdJurusan' => 1,
        ]);

        \App\Models\User::create([
            'Username' => $mahasiswa1->NIM,  
            'Password' => bcrypt('password'),
            'Role' => 'mahasiswa',
            'IdMahasiswa' => $mahasiswa1->IdMahasiswa,
        ]);
        
        $mahasiswa2 = \App\Models\Mahasiswa::create([
            'Nama' => 'Siti Nurhaliza',
            'NIM' => '202301002',
            'Email' => 'siti@polkisma.ac.id',
            'NoTelpon' => '089876543211',
            'TahunMasuk' => '2023',
            'IdJurusan' => 1,
        ]);
        
        \App\Models\User::create([
            'Username' => $mahasiswa2->NIM,  // Gunakan NIM sebagai Username
            'Password' => bcrypt('password'),
            'Role' => 'mahasiswa',
            'IdMahasiswa' => $mahasiswa2->IdMahasiswa,
        ]);
        
        $mahasiswa3 = \App\Models\Mahasiswa::create([
            'Nama' => 'Budi Santoso',
            'NIM' => '202301003',
            'Email' => 'budi@polkisma.ac.id',
            'NoTelpon' => '089876543212',
            'TahunMasuk' => '2023',
            'IdJurusan' => 1,
        ]);
        
        \App\Models\User::create([
            'Username' => $mahasiswa3->NIM,  // Gunakan NIM sebagai Username
            'Password' => bcrypt('password'),
            'Role' => 'mahasiswa',
            'IdMahasiswa' => $mahasiswa3->IdMahasiswa,
        ]);
        
        // Matakuliah
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
        
        // Jadwal
        $jadwal1 = \App\Models\Jadwal::create([
            'IdDosen' => $dosen->IdDosen,
            'KodeMK' => $mk1->KodeMK,
            'Hari' => 'Senin',
            'Jam' => '08:00-10:30',
            'Kelas' => 'TI-1A',
            'Ruang' => 'Lab Komputer 1',
        ]);
        
        $jadwal2 = \App\Models\Jadwal::create([
            'IdDosen' => $dosen->IdDosen,
            'KodeMK' => $mk2->KodeMK,
            'Hari' => 'Rabu',
            'Jam' => '10:00-12:30',
            'Kelas' => 'TI-1A',
            'Ruang' => 'Lab Komputer 2',
        ]);
        
        $jadwal3 = \App\Models\Jadwal::create([
            'IdDosen' => $dosen->IdDosen,
            'KodeMK' => $mk3->KodeMK,
            'Hari' => 'Jumat',
            'Jam' => '13:00-15:30',
            'Kelas' => 'TI-1A',
            'Ruang' => 'Lab Komputer 1',
        ]);
        
        // KRS untuk Mahasiswa 1
        $krs1 = \App\Models\Krs::create([
            'IdMahasiswa' => $mahasiswa1->IdMahasiswa,
            'semester' => 1,
        ]);
        
        \App\Models\KrsDetail::create([
            'krs_id' => $krs1->id,
            'jadwal_id' => $jadwal1->IdJadwal,
        ]);
        
        \App\Models\KrsDetail::create([
            'krs_id' => $krs1->id,
            'jadwal_id' => $jadwal2->IdJadwal,
        ]);
        
        \App\Models\KrsDetail::create([
            'krs_id' => $krs1->id,
            'jadwal_id' => $jadwal3->IdJadwal,
        ]);
        
        // KRS untuk Mahasiswa 2
        $krs2 = \App\Models\Krs::create([
            'IdMahasiswa' => $mahasiswa2->IdMahasiswa,
            'semester' => 1,
        ]);
        
        \App\Models\KrsDetail::create([
            'krs_id' => $krs2->id,
            'jadwal_id' => $jadwal1->IdJadwal,
        ]);
        
        \App\Models\KrsDetail::create([
            'krs_id' => $krs2->id,
            'jadwal_id' => $jadwal2->IdJadwal,
        ]);
        
        // KRS untuk Mahasiswa 3
        $krs3 = \App\Models\Krs::create([
            'IdMahasiswa' => $mahasiswa3->IdMahasiswa,
            'semester' => 1,
        ]);
        
        \App\Models\KrsDetail::create([
            'krs_id' => $krs3->id,
            'jadwal_id' => $jadwal1->IdJadwal,
        ]);
        
        \App\Models\KrsDetail::create([
            'krs_id' => $krs3->id,
            'jadwal_id' => $jadwal3->IdJadwal,
        ]);
    }
}
