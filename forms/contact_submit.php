<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once dirname(__DIR__) . '/includes/boot.php';

header('Content-Type: text/plain; charset=UTF-8');

function fail_response(string $userMessage, int $status = 422, ?string $logDetail = null): never
{
    if ($logDetail !== null) {
        error_log('Contact form: ' . $logDetail);
    }

    http_response_code($status);
    exit($userMessage);
}

function clean_text(?string $value, int $maxLength = 255): string
{
    $value = trim((string) $value);
    $value = preg_replace('/\s+/', ' ', $value) ?? '';
    return mb_substr($value, 0, $maxLength);
}

function clean_message(?string $value, int $maxLength = 3000): string
{
    $value = trim((string) $value);
    $value = str_replace(["\r\n", "\r"], "\n", $value);
    return mb_substr($value, 0, $maxLength);
}

function client_ip(): string
{
    return (string) ($_SERVER['REMOTE_ADDR'] ?? '');
}

function smtp_encryption(): string
{
    $encryption = strtolower((string) (defined('ZOHO_SMTP_ENCRYPTION') ? ZOHO_SMTP_ENCRYPTION : 'ssl'));

    return match ($encryption) {
        'tls', 'starttls' => PHPMailer::ENCRYPTION_STARTTLS,
        'none', ''       => '',
        default          => PHPMailer::ENCRYPTION_SMTPS,
    };
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail_response('Invalid request method.', 405, 'Invalid request method');
}

/*
|--------------------------------------------------------------------------
| Security fields
|--------------------------------------------------------------------------
*/
$csrfToken        = (string) ($_POST['csrf_token'] ?? '');
$sessionCsrfToken = (string) ($_SESSION['csrf_token'] ?? '');
$honeypot         = trim((string) ($_POST['company_website'] ?? ''));
$recaptchaToken   = trim((string) ($_POST['g-recaptcha-response'] ?? ''));
$recaptchaAction  = trim((string) ($_POST['recaptcha_action'] ?? ''));
$recaptchaEnabled = defined('RECAPTCHA_V3_SECRET_KEY') && RECAPTCHA_V3_SECRET_KEY !== '';

if ($honeypot !== '') {
    fail_response('Unable to send your message. Please try again.', 400, 'Honeypot triggered');
}

if ($csrfToken === '' || $sessionCsrfToken === '' || !hash_equals($sessionCsrfToken, $csrfToken)) {
    fail_response('Security validation failed. Please refresh the page and try again.', 400, 'CSRF validation failed');
}

/*
|--------------------------------------------------------------------------
| Rate limit
|--------------------------------------------------------------------------
*/
$now = time();
$lastSubmit = (int) ($_SESSION['contact_last_submit'] ?? 0);

if (($now - $lastSubmit) < 15) {
    fail_response('Please wait a few seconds before sending another message.', 429, 'Rate limit exceeded');
}

/*
|--------------------------------------------------------------------------
| Form fields
|--------------------------------------------------------------------------
*/
$name    = clean_text($_POST['name'] ?? '', 100);
$email   = clean_text($_POST['email'] ?? '', 150);
$subject = clean_text($_POST['subject'] ?? '', 150);
$message = clean_message($_POST['message'] ?? '', 3000);

if ($name === '' || mb_strlen($name) < 2) {
    fail_response('Please enter a valid name.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    fail_response('Please enter a valid email address.');
}

if ($subject === '' || mb_strlen($subject) < 3) {
    fail_response('Please enter a valid subject.');
}

if ($message === '' || mb_strlen($message) < 10) {
    fail_response('Please enter a valid message.');
}

/*
|--------------------------------------------------------------------------
| reCAPTCHA v3 verification (only when configured)
|--------------------------------------------------------------------------
*/
$captchaScore = '';

if ($recaptchaEnabled) {
    if ($recaptchaToken === '') {
        fail_response('Security verification failed. Please refresh the page and try again.', 400, 'Missing reCAPTCHA token');
    }

    if ($recaptchaAction !== 'contact_form') {
        fail_response('Security verification failed. Please try again.', 400, 'Invalid reCAPTCHA action');
    }

    $verifyPostData = http_build_query([
        'secret'   => RECAPTCHA_V3_SECRET_KEY,
        'response' => $recaptchaToken,
        'remoteip' => client_ip(),
    ]);

    $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');

    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $verifyPostData,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
    ]);

    $verifyResult = curl_exec($ch);
    $curlError = curl_error($ch);
    $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($verifyResult === false || $curlError !== '') {
        fail_response('Unable to verify your submission. Please try again later.', 500, 'reCAPTCHA cURL error: ' . $curlError);
    }

    if ($httpCode !== 200) {
        fail_response('Unable to verify your submission. Please try again later.', 500, 'reCAPTCHA HTTP code: ' . (string) $httpCode);
    }

    $captchaData = json_decode((string) $verifyResult, true);

    if (!is_array($captchaData)) {
        fail_response('Unable to verify your submission. Please try again later.', 500, 'Invalid reCAPTCHA response');
    }

    if (empty($captchaData['success'])) {
        fail_response('Security verification failed. Please try again.', 400, 'reCAPTCHA verification failed');
    }

    if ((string) ($captchaData['action'] ?? '') !== 'contact_form') {
        fail_response('Security verification failed. Please try again.', 400, 'reCAPTCHA action mismatch');
    }

    $captchaScore = (string) ($captchaData['score'] ?? '');

    if ((float) ($captchaData['score'] ?? 0) < 0.5) {
        fail_response('Your message could not be sent. Please try again later.', 400, 'reCAPTCHA score too low: ' . $captchaScore);
    }
}

/*
|--------------------------------------------------------------------------
| Mail config validation
|--------------------------------------------------------------------------
*/
if (
    !defined('ZOHO_SMTP_HOST') ||
    !defined('ZOHO_SMTP_PORT') ||
    !defined('ZOHO_SMTP_USER') ||
    !defined('ZOHO_APP_PASSWORD') ||
    !defined('MAIL_FROM_ADDRESS') ||
    !defined('MAIL_FROM_NAME') ||
    !defined('MAIL_INBOX_ADDRESS') ||
    !defined('MAIL_INBOX_NAME')
) {
    fail_response('The contact form is temporarily unavailable. Please try again later.', 500, 'Mail configuration is incomplete');
}

if (ZOHO_APP_PASSWORD === '') {
    fail_response('The contact form is temporarily unavailable. Please try again later.', 500, 'Zoho app password is empty');
}

/*
|--------------------------------------------------------------------------
| Send email
|--------------------------------------------------------------------------
*/
try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = ZOHO_SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = ZOHO_SMTP_USER;
    $mail->Password   = ZOHO_APP_PASSWORD;
    $mail->Port       = (int) ZOHO_SMTP_PORT;
    $mail->CharSet    = 'UTF-8';
    $mail->Encoding   = 'base64';

    $encryption = smtp_encryption();
    if ($encryption === PHPMailer::ENCRYPTION_SMTPS) {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAutoTLS = false;
    } elseif ($encryption !== '') {
        $mail->SMTPSecure = $encryption;
    }

    $mail->Sender = MAIL_FROM_ADDRESS;
    $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME, true);

    $inboxName = trim(str_replace(['"', "'"], '', MAIL_INBOX_NAME));
    $mail->addAddress(MAIL_INBOX_ADDRESS, $inboxName);
    $mail->addReplyTo($email, $name);

    $mail->Subject = '[Portfolio Contact] ' . $subject;
    $mail->isHTML(false);

    $body = [];
    $body[] = 'New portfolio contact message';
    $body[] = '----------------------------------------';
    $body[] = 'Name: ' . $name;
    $body[] = 'Email: ' . $email;
    $body[] = 'Subject: ' . $subject;
    $body[] = 'IP: ' . client_ip();

    if ($recaptchaEnabled) {
        $body[] = 'reCAPTCHA score: ' . $captchaScore;
    }

    $body[] = '';
    $body[] = 'Message:';
    $body[] = $message;

    $mail->Body = implode(PHP_EOL, $body);

    $mail->send();

    $_SESSION['contact_last_submit'] = $now;
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

    header('X-CSRF-Token: ' . $_SESSION['csrf_token']);
    exit('OK');
} catch (Exception $e) {
    fail_response('Unable to send your message right now. Please try again later.', 500, 'Mailer error: ' . $e->getMessage());
}
