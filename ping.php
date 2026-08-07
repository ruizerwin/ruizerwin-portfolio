<?php

declare(strict_types=1);

header('Content-Type: text/plain; charset=UTF-8');

$root = __DIR__;
$appEnv = 'production';

if (is_file($root . '/.env')) {
    foreach (file($root . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [] as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);

        if (trim($key) === 'APP_ENV') {
            $appEnv = trim($value, " \t\"'");
            break;
        }
    }
}

$isLocal = in_array($appEnv, ['local', 'development'], true);
$remoteAddr = (string) ($_SERVER['REMOTE_ADDR'] ?? '');
$isLoopback = in_array($remoteAddr, ['127.0.0.1', '::1'], true);

if (!$isLocal && !$isLoopback) {
    http_response_code(404);
    exit('Not found');
}

echo "PHP OK: " . PHP_VERSION . "\n";
echo "vendor/autoload.php: " . (is_file(__DIR__ . '/vendor/autoload.php') ? 'YES' : 'NO') . "\n";
echo ".env: " . (is_file(__DIR__ . '/.env') ? 'YES' : 'NO') . "\n";
