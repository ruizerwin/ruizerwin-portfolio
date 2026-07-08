<?php

declare(strict_types=1);

header('Content-Type: text/plain; charset=UTF-8');

echo "PHP OK: " . PHP_VERSION . "\n";
echo "vendor/autoload.php: " . (is_file(__DIR__ . '/vendor/autoload.php') ? 'YES' : 'NO') . "\n";
echo ".env: " . (is_file(__DIR__ . '/.env') ? 'YES' : 'NO') . "\n";
