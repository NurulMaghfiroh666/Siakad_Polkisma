<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $mahasiswas = [
            [
                'NIM' => '2021001',
                'Nama' => 'Budi Santoso',
                'Email' => 'budi@student.polkisma.ac.id',
                'NoTelpon' => '081234567891',
                'TahunMasuk' => 2021,
                'IdJurusan' => 1
            ],
            [
                'NIM' => '2021002',
                'Nama' => 'Siti Nurhaliza',
                'Email' => 'siti@student.polkisma.ac.id',
                'NoTelpon' => '081234567892',
                'TahunMasuk' => 2021,
                'IdJurusan' => 1
            ],
            [
                'NIM' => '2022001',
                'Nama' => 'Ahmad Fauzi',
                'Email' => 'ahmad@student.polkisma.ac.id',
                'NoTelpon' => '081234567893',
                'TahunMasuk' => 2022,
                'IdJurusan' => 2
            ],
            [
                'NIM' => '2022002',
                'Nama' => 'Dewi Lestari',
                'Email' => 'dewi@student.polkisma.ac.id',
                'NoTelpon' => '081234567894',
                'TahunMasuk' => 2022,
                'IdJurusan' => 2
            ],
            [
                'NIM' => '2023001',
                'Nama' => 'Rahmat Hidayat',
                'Email' => 'rahmat@student.polkisma.ac.id',
                'NoTelpon' => '081234567895',
                'TahunMasuk' => 2023,
                'IdJurusan' => 1
            ],
        ];

        foreach ($mahasiswas as $mhsData) {
            DB::beginTransaction();
            try {
                // Create mahasiswa
                $mahasiswa = Mahasiswa::create($mhsData);

                // Create user account (using correct column names)
                User::create([
                    'IdMahasiswa' => $mahasiswa->IdMahasiswa,
                    'Username' => $mhsData['NIM'], // Username = NIM
                    'Password' => Hash::make($mhsData['NIM']), // Password = NIM
                    'Role' => 'mahasiswa'
                ]);

                DB::commit();
                $this->command->info("Mahasiswa {$mhsData['Nama']} berhasil ditambahkan");
            } catch (\Exception $e) {
                DB::rollback();
                $this->command->error("Error creating mahasiswa {$mhsData['Nama']}: " . $e->getMessage());
            }
        }
    }
}
