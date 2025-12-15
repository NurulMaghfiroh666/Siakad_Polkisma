<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if admin already exists to prevent duplicate errors
        if (User::where('Role', 'admin')->exists()) {
            return;
        }

        // Create Admin Profile
        $admin = Admin::create([
            'Nama' => 'Administrator',
            'Email' => 'admin@polkisma.ac.id',
            'NoTelpon' => '081234567890',
        ]);

        // Create Admin Account
        User::create([
            'Username' => 'admin',
            'Password' => Hash::make('password'), // Default password
            'Role' => 'admin',
            'IdAdmin' => $admin->IdAdmin,
        ]);
    }
}
