<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Authentication ===" . PHP_EOL . PHP_EOL;

// Test 1: Check if admin user exists
$admin = \App\Models\User::where('Username', 'admin')->first();
if ($admin) {
    echo "✓ Admin user found in database" . PHP_EOL;
    echo "  Username: " . $admin->Username . PHP_EOL;
    echo "  Role: " . $admin->Role . PHP_EOL;
    
    // Try to authenticate
    $passwordToTest = 'password';
    $hashedPassword = $admin->getAuthPassword();
    
    echo "  Stored password hash: " . substr($hashedPassword, 0, 30) . "..." . PHP_EOL;
    
    // Test if password matches
    if (\Illuminate\Support\Facades\Hash::check($passwordToTest, $hashedPassword)) {
        echo "✓ Password 'password' matches the hash!" . PHP_EOL;
    } else {
        echo "✗ Password 'password' does NOT match the hash!" . PHP_EOL;
    }
    
    // Test Auth::attempt
    if (\Illuminate\Support\Facades\Auth::attempt(['Username' => 'admin', 'Password' => 'password'])) {
        echo "✓ Auth::attempt() succeeded!" . PHP_EOL;
        $user = \Illuminate\Support\Facades\Auth::user();
        echo "  Logged in as: " . $user->Username . " (" . $user->Role . ")" . PHP_EOL;
    } else {
        echo "✗ Auth::attempt() failed!" . PHP_EOL;
        
        // Debug: Try different combinations
        echo PHP_EOL . "Debugging Auth::attempt()..." . PHP_EOL;
        
        // Try with lowercase password
        if (\Illuminate\Support\Facades\Auth::attempt(['Username' => 'admin', 'password' => 'password'])) {
            echo "✓ Works with lowercase 'password' key" . PHP_EOL;
        } else {
            echo "✗ Doesn't work with lowercase 'password' key" . PHP_EOL;
        }
    }
} else {
    echo "✗ Admin user NOT found in database!" . PHP_EOL;
}

echo PHP_EOL . "=== Testing Complete ===" . PHP_EOL;
