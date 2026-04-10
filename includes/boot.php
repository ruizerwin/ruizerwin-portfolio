<?php

declare(strict_types=1);

define('APP_NAME', 'ruizerwin');
define('APP_URL', 'https://ruizerwin.com');


// reCAPTCHA
define('CONTACT_RECAPTCHA_SITE_KEY', '6LcysqgsAAAAAGhURbJWYXlTP7dnNcqiuBNHiIq4');
define('CONTACT_RECAPTCHA_SECRET_KEY', '6LcysqgsAAAAADX3Qa3SRXVjdegN-3PgjKs4wewc');

define('SMTP_HOST', 'smtp.zohocloud.ca');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', 'contact@ruizerwin.com');
define('SMTP_PASSWORD', '1s1=JL^s>sTtEtt6iKc]'); // app password

define('SMTP_FROM_EMAIL', 'contact@ruizerwin.com');
define('SMTP_FROM_NAME', APP_NAME);

// testing destination
define('CONTACT_TO_EMAIL', 'ruizerwin1@gmail.com');
define('CONTACT_TO_NAME', 'Erwin Padilla');

/**
 * Optional dynamic values
 * Set these before including head.php when needed.
 */
$pageTitle       = $pageTitle ?? APP_NAME . ' | PHP Developer';
$pageDescription = $pageDescription ?? 'Ruiz Erwin portfolio website. PHP developer specialized in PHP 8.2+, Laravel, CodeIgniter, MySQL, Bootstrap, JavaScript, and modern web application development.';
$pageKeywords    = $pageKeywords ?? 'Ruiz Erwin, PHP Developer, PHP 8.2, Laravel, CodeIgniter, MySQL, SQL, Bootstrap, JavaScript, Web Developer, Portfolio';
$pageUrl         = $pageUrl ?? ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/');
$pageImage       = $pageImage ?? 'assets/img/og-image.jpg';
$pageType        = $pageType ?? 'website';
$pageRobots      = $pageRobots ?? 'index, follow';
