<?php

declare(strict_types=1);

header('Content-Type: text/plain; charset=UTF-8');

$root = __DIR__;

echo "=== ruizerwin.com health check ===\n\n";
echo 'PHP version: ' . PHP_VERSION . "\n";
echo 'Server time: ' . date('Y-m-d H:i:s') . "\n\n";

echo ".env exists: " . (is_file($root . '/.env') ? 'YES' : 'NO') . "\n";
echo ".env readable: " . (is_readable($root . '/.env') ? 'YES' : 'NO') . "\n";
echo "vendor/autoload.php: " . (is_file($root . '/vendor/autoload.php') ? 'YES' : 'NO') . "\n";
echo "index.php: " . (is_file($root . '/index.php') ? 'YES' : 'NO') . "\n\n";

if (!is_file($root . '/vendor/autoload.php')) {
    echo "FIX: cd /var/www/ruizerwin.com && composer install --no-dev\n";
    exit;
}

require_once $root . '/vendor/autoload.php';

echo "Composer autoload: OK\n";

if (is_file($root . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable($root);
    $dotenv->safeLoad();
    echo ".env loaded: OK\n";
    echo 'APP_ENV: ' . ($_ENV['APP_ENV'] ?? '(not set)') . "\n";
    echo 'ZOHO_APP_PASSWORD set: ' . (($_ENV['ZOHO_APP_PASSWORD'] ?? '') !== '' ? 'YES' : 'NO') . "\n";
    echo 'RECAPTCHA_V3_SITE_KEY set: ' . (($_ENV['RECAPTCHA_V3_SITE_KEY'] ?? '') !== '' ? 'YES' : 'NO') . "\n";
} else {
    echo ".env loaded: SKIPPED (file missing)\n";
}

echo "\nTrying boot.php...\n";

try {
    require $root . '/includes/boot.php';
    echo "boot.php: OK\n";
    echo 'APP_NAME: ' . APP_NAME . "\n";
} catch (Throwable $e) {
    echo "boot.php ERROR: " . $e->getMessage() . "\n";
    echo $e->getFile() . ':' . $e->getLine() . "\n";
}

echo "\nDone.\n";
