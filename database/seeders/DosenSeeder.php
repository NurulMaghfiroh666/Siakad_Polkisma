<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $dosens = [
            [
                'NIP' => '198702022011012001',
                'Nama' => 'Dra. Sri Wahyuni, M.T',
                'Email' => 'sri@polkisma.ac.id',
                'NoTelpon' => '081234567802',
            ],
            [
                'NIP' => '199003032012011001',
                'Nama' => 'Ahmad Yusuf, S.Kom, M.Cs',
                'Email' => 'yusuf@polkisma.ac.id',
                'NoTelpon' => '081234567803',
            ],
            [
                'NIP' => '199205042013012001',
                'Nama' => 'Rika Sari, S.T, M.T',
                'Email' => 'rika@polkisma.ac.id',
                'NoTelpon' => '081234567804',
            ],
        ];

        foreach ($dosens as $dosenData) {
            DB::beginTransaction();
            try {
                // Create dosen
                $dosen = Dosen::create($dosenData);

                // Create user account (using correct column names)
                User::create([
                    'IdDosen' => $dosen->IdDosen,
                    'Username' => $dosenData['NIP'], // Username = NIP
                    'Password' => Hash::make($dosenData['NIP']), // Password = NIP
                    'Role' => 'dosen'
                ]);

                DB::commit();
                $this->command->info("Dosen {$dosenData['Nama']} berhasil ditambahkan");
            } catch (\Exception $e) {
                DB::rollback();
                $this->command->error("Error creating dosen {$dosenData['Nama']}: " . $e->getMessage());
            }
        }
    }
}
