<?php

declare(strict_types=1);

use Dotenv\Dotenv;

$projectRoot = dirname(__DIR__);
$autoload = $projectRoot . '/vendor/autoload.php';

if (!is_file($autoload)) {
    die('Missing Composer autoload file: vendor/autoload.php');
}

require_once $autoload;

if (!class_exists(Dotenv::class)) {
    die('vlucas/phpdotenv is not installed.');
}

if (!is_file($projectRoot . '/.env')) {
    die('Missing .env file in project root.');
}

$dotenv = Dotenv::createImmutable($projectRoot);
$dotenv->safeLoad();

define('APP_NAME', $_ENV['APP_NAME'] ?? 'ruizerwin');
define('APP_URL', $_ENV['APP_URL'] ?? 'https://ruizerwin.com');

define('CONTACT_RECAPTCHA_SITE_KEY', $_ENV['CONTACT_RECAPTCHA_SITE_KEY'] ?? '');
define('CONTACT_RECAPTCHA_SECRET_KEY', $_ENV['CONTACT_RECAPTCHA_SECRET_KEY'] ?? '');

define('SMTP_HOST', $_ENV['SMTP_HOST'] ?? 'smtp.zohocloud.ca');
define('SMTP_PORT', (int)($_ENV['SMTP_PORT'] ?? 465));
define('SMTP_USERNAME', $_ENV['SMTP_USERNAME'] ?? 'contact@ruizerwin.com');
define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD'] ?? '');

define('SMTP_FROM_EMAIL', $_ENV['SMTP_FROM_EMAIL'] ?? 'contact@ruizerwin.com');
define('SMTP_FROM_NAME', $_ENV['SMTP_FROM_NAME'] ?? APP_NAME);

define('CONTACT_TO_EMAIL', $_ENV['CONTACT_TO_EMAIL'] ?? 'ruizerwin1@gmail.com');
define('CONTACT_TO_NAME', $_ENV['CONTACT_TO_NAME'] ?? 'Erwin Padilla');

$pageTitle = $pageTitle ?? APP_NAME . ' | PHP Developer';
$pageDescription = $pageDescription ?? 'Ruiz Erwin portfolio website. PHP developer specialized in PHP 8.2+, Laravel, CodeIgniter, MySQL, Bootstrap, JavaScript, and modern web application development.';
$pageKeywords = $pageKeywords ?? 'Ruiz Erwin, PHP Developer, PHP 8.2, Laravel, CodeIgniter, MySQL, SQL, Bootstrap, JavaScript, Web Developer, Portfolio';
$pageUrl = $pageUrl ?? (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/'));
$pageImage = $pageImage ?? 'assets/img/og-image.jpg';
$pageType = $pageType ?? 'website';
$pageRobots = $pageRobots ?? 'index, follow';
