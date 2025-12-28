<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Database Verification ===" . PHP_EOL . PHP_EOL;

$users = \App\Models\User::all();

echo "Total users in database: " . $users->count() . PHP_EOL . PHP_EOL;

echo "User Details:" . PHP_EOL;
echo str_repeat("-", 60) . PHP_EOL;

foreach ($users as $user) {
    echo "ID: " . $user->Id . PHP_EOL;
    echo "Username: " . $user->Username . PHP_EOL;
    echo "Role: " . $user->Role . PHP_EOL;
    echo str_repeat("-", 60) . PHP_EOL;
    echo str_repeat("-", 60) . PHP_EOL;
}

echo PHP_EOL . "Admin user exists: " . (\App\Models\User::where('Role', 'admin')->exists() ? 'YES' : 'NO') . PHP_EOL;
echo "Dosen user exists: " . (\App\Models\User::where('Role', 'dosen')->exists() ? 'YES' : 'NO') . PHP_EOL;
echo "Mahasiswa user exists: " . (\App\Models\User::where('Role', 'mahasiswa')->exists() ? 'YES' : 'NO') . PHP_EOL;
