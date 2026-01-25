<?php
// Simple script to read .env file directly
$envContent = file_get_contents(__DIR__.'/.env');

// Parse the .env file
$lines = explode("\n", $envContent);
foreach ($lines as $line) {
    if (strpos($line, '=') !== false && !str_starts_with(trim($line), '#')) {
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        
        // Remove quotes if present
        if ((startsWith($value, '"') && endsWith($value, '"')) ||
            (startsWith($value, "'") && endsWith($value, "'"))) {
            $value = substr($value, 1, -1);
        }
        
        echo "$key: $value\n";
    }
}

function startsWith($haystack, $needle) {
    return substr($haystack, 0, strlen($needle)) === $needle;
}

function endsWith($haystack, $needle) {
    return substr($haystack, -strlen($needle)) === $needle;
}