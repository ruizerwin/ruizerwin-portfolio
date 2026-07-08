<?php

declare(strict_types=1);

use Dotenv\Dotenv;

$projectRoot = dirname(__DIR__);
$autoloadFile = $projectRoot . '/vendor/autoload.php';
$envFile = $projectRoot . '/.env';

$appEnv = $_ENV['APP_ENV'] ?? 'production';

if (in_array($appEnv, ['local', 'development'], true)) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
} else {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
}

error_reporting(E_ALL);
ini_set('log_errors', '1');

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!is_file($autoloadFile)) {
    die('Missing Composer autoload file: ' . $autoloadFile);
}

require_once $autoloadFile;

if (!class_exists(Dotenv::class)) {
    die('vlucas/phpdotenv is not installed.');
}

if (is_file($envFile)) {
    $dotenv = Dotenv::createImmutable($projectRoot);
    $dotenv->safeLoad();
}

define('APP_NAME', $_ENV['APP_NAME'] ?? 'ruizerwin');
define('APP_URL', rtrim($_ENV['APP_URL'] ?? 'https://ruizerwin.com', '/'));

// reCAPTCHA
define('CONTACT_RECAPTCHA_SITE_KEY', $_ENV['CONTACT_RECAPTCHA_SITE_KEY'] ?? '');
define('CONTACT_RECAPTCHA_SECRET_KEY', $_ENV['CONTACT_RECAPTCHA_SECRET_KEY'] ?? '');

// SMTP
define('SMTP_HOST', $_ENV['SMTP_HOST'] ?? 'smtp.zohocloud.ca');
define('SMTP_PORT', (int) ($_ENV['SMTP_PORT'] ?? 465));
define('SMTP_USERNAME', $_ENV['SMTP_USERNAME'] ?? 'contact@ruizerwin.com');
define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD'] ?? '');
define('SMTP_ENCRYPTION', $_ENV['SMTP_ENCRYPTION'] ?? 'ssl');

define('SMTP_FROM_EMAIL', $_ENV['SMTP_FROM_EMAIL'] ?? 'contact@ruizerwin.com');
define('SMTP_FROM_NAME', $_ENV['SMTP_FROM_NAME'] ?? APP_NAME);

// contact destination
define('CONTACT_TO_EMAIL', $_ENV['CONTACT_TO_EMAIL'] ?? 'ruizerwin1@gmail.com');
define('CONTACT_TO_NAME', $_ENV['CONTACT_TO_NAME'] ?? 'Erwin Padilla');

/**
 * Optional dynamic values
 * Set these before including head.php when needed.
 */
$pageTitle = $pageTitle ?? APP_NAME . ' | PHP Developer';
$pageDescription = $pageDescription ?? 'Erwin D. Padilla — Senior PHP Full-Stack Developer in London, ON. 8+ years in Laravel, Drupal, CodeIgniter, MySQL, AWS. Accepted into Fanshawe College AI & Machine Learning program.';
$pageKeywords = $pageKeywords ?? 'Ruiz Erwin, PHP Developer, PHP 8.2, Laravel, CodeIgniter, MySQL, SQL, Bootstrap, JavaScript, Web Developer, Portfolio';
$pageUrl = $pageUrl ?? (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/'));
$pageImage = $pageImage ?? 'assets/img/og-image.jpg';
$pageType = $pageType ?? 'website';
$pageRobots = $pageRobots ?? 'index, follow';
