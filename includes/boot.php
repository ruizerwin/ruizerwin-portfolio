<?php

declare(strict_types=1);

use Dotenv\Dotenv;

$projectRoot = dirname(__DIR__);
$autoloadFile = $projectRoot . '/vendor/autoload.php';
$envFile = $projectRoot . '/.env';

if (!is_file($autoloadFile)) {
    http_response_code(500);
    exit('Missing Composer autoload. Run: composer install --no-dev');
}

require_once $autoloadFile;

if (!class_exists(Dotenv::class)) {
    http_response_code(500);
    exit('phpdotenv is not installed. Run: composer install --no-dev');
}

if (is_file($envFile)) {
    $dotenv = Dotenv::createImmutable($projectRoot);
    $dotenv->safeLoad();
}

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

define('APP_NAME', $_ENV['APP_NAME'] ?? 'ruizerwin');
define('APP_URL', rtrim($_ENV['APP_URL'] ?? 'https://ruizerwin.com', '/'));

// reCAPTCHA v3 (supports new and legacy .env names)
define('RECAPTCHA_V3_SITE_KEY', $_ENV['RECAPTCHA_V3_SITE_KEY'] ?? $_ENV['CONTACT_RECAPTCHA_SITE_KEY'] ?? '');
define('RECAPTCHA_V3_SECRET_KEY', $_ENV['RECAPTCHA_V3_SECRET_KEY'] ?? $_ENV['CONTACT_RECAPTCHA_SECRET_KEY'] ?? '');

// Zoho Mail SMTP (supports new and legacy .env names)
define('ZOHO_SMTP_HOST', $_ENV['ZOHO_SMTP_HOST'] ?? $_ENV['SMTP_HOST'] ?? 'smtp.zohocloud.ca');
define('ZOHO_SMTP_PORT', (int) ($_ENV['ZOHO_SMTP_PORT'] ?? $_ENV['SMTP_PORT'] ?? 465));
define('ZOHO_SMTP_USER', $_ENV['ZOHO_SMTP_USER'] ?? $_ENV['SMTP_USERNAME'] ?? 'contact@ruizerwin.com');
define('ZOHO_APP_PASSWORD', $_ENV['ZOHO_APP_PASSWORD'] ?? $_ENV['SMTP_PASSWORD'] ?? '');
define('ZOHO_SMTP_ENCRYPTION', $_ENV['ZOHO_SMTP_ENCRYPTION'] ?? $_ENV['SMTP_ENCRYPTION'] ?? 'ssl');

define('MAIL_FROM_ADDRESS', $_ENV['MAIL_FROM_ADDRESS'] ?? $_ENV['SMTP_FROM_EMAIL'] ?? 'contact@ruizerwin.com');
define('MAIL_FROM_NAME', $_ENV['MAIL_FROM_NAME'] ?? $_ENV['SMTP_FROM_NAME'] ?? APP_NAME);

// Contact form inbox (supports new and legacy .env names)
define('MAIL_INBOX_ADDRESS', $_ENV['MAIL_INBOX_ADDRESS'] ?? $_ENV['CONTACT_TO_EMAIL'] ?? 'ruizerwin1@gmail.com');
define('MAIL_INBOX_NAME', $_ENV['MAIL_INBOX_NAME'] ?? $_ENV['CONTACT_TO_NAME'] ?? 'Erwin Padilla');

define('LINKEDIN_URL', 'https://www.linkedin.com/in/ruizerwin/');
define('RESUME_PDF_FILE', 'assets/downloads/Erwin_Padilla_Resume.pdf');
define('RESUME_PDF_AVAILABLE', is_file($projectRoot . '/' . RESUME_PDF_FILE));

/**
 * Optional dynamic values
 * Set these before including head.php when needed.
 */
$pageTitle = $pageTitle ?? APP_NAME . ' | PHP Developer';
$pageDescription = $pageDescription ?? 'Erwin D. Padilla — Senior PHP Full-Stack Developer in London, ON. 17+ years since 2007 in Laravel, Drupal, CodeIgniter, MySQL, AWS.';
$pageKeywords = $pageKeywords ?? 'Ruiz Erwin, PHP Developer, PHP 8.2, Laravel, CodeIgniter, MySQL, SQL, Bootstrap, JavaScript, Web Developer, Portfolio';
$pageUrl = $pageUrl ?? (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/'));
$pageImage = $pageImage ?? 'assets/img/og-image.jpg';
$pageType = $pageType ?? 'website';
$pageRobots = $pageRobots ?? 'index, follow';
