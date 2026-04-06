<?php

require __DIR__ . '/functions.php';

foreach (glob(__DIR__ . '/tests/*.php') as $file) {
    require $file;
}

global $tests;

$passed = 0;
$failed = 0;

foreach ($tests as [$desc, $fn]) {
    try {
        $fn();
        echo "✅ $desc\n";
        $passed++;
    } catch (Throwable $e) {
        echo "❌ $desc\n";
        echo "   " . $e->getMessage() . PHP_EOL;
        $failed++;
    }
}

echo PHP_EOL . "$passed passou, $failed falhou" . PHP_EOL;
