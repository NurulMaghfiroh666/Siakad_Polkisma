<?php
$envFile = '.env';
$content = file_get_contents($envFile);

// Define replacements
$replacements = [
    '/DB_CONNECTION=sqlite/' => 'DB_CONNECTION=mysql',
    '/# DB_HOST=127.0.0.1/' => 'DB_HOST=127.0.0.1',
    '/# DB_PORT=3306/' => 'DB_PORT=3306',
    '/# DB_DATABASE=laravel/' => 'DB_DATABASE=kampusdb',
    '/# DB_USERNAME=root/' => 'DB_USERNAME=root',
    '/# DB_PASSWORD=/' => 'DB_PASSWORD=',
];

$content = preg_replace(array_keys($replacements), array_values($replacements), $content);

file_put_contents($envFile, $content);
echo "Updated .env file successfully.\n";
