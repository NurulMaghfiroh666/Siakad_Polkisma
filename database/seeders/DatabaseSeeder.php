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
        $dosenUser = \App\Models\User::create([
            'name' => 'Budi Santoso',
            'email' => 'dosen@polkisma.ac.id',
            'password' => bcrypt('password'),
            'role' => 'dosen',
        ]);
        
        \App\Models\Dosen::create([
            'user_id' => $dosenUser->id,
            'nip' => '198501012010011001',
        ]);

        // Mahasiswa
        $mhsUser = \App\Models\User::create([
            'name' => 'Siti Aminah',
            'email' => 'mahasiswa@polkisma.ac.id',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);

        \App\Models\Mahasiswa::create([
            'user_id' => $mhsUser->id,
            'nim' => '202301001',
            'jurusan' => 'Teknik Informatika',
        ]);
        
        // Matakuliah Dummy
        \App\Models\Matakuliah::create([
            'kode' => 'TI101',
            'nama' => 'Algoritma dan Pemrograman',
            'sks' => 3,
        ]);
    }
}
