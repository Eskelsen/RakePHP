<?php

# Dev Mode: Show Errors
ini_set('display_errors', true);
ini_set('display_startup_erros', true);
error_reporting(E_ALL);

# Erros Log Output
ini_set('log_errors', true);
ini_set('error_log', __DIR__  . '/errors.log');

require __DIR__ . '/src/retro-compatibility.php';
require __DIR__ . '/src/rake.php';

foreach (glob(__DIR__ . '/tests/*.php') as $file) {
    require $file;
}

global $tests;

$passed = 0;
$failed = 0;

foreach ($tests as [$desc, $fn]) {
    try {
        $fn();
        echo "✅ $desc" . PHP_EOL;
        $passed++;
    } catch (Throwable $e) {
        echo "❌ $desc: " . $e->getMessage() . PHP_EOL;
        $failed++;
    }
}

echo PHP_EOL . "✅ Ok: $passed\n❌ Erros: $failed" . PHP_EOL;
