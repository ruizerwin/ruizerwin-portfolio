<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once dirname(__DIR__) . '/includes/boot.php';

header('Content-Type: text/plain; charset=UTF-8');

function fail_response(string $message, int $status = 422): never
{
    http_response_code($status);
    exit($message);
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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail_response('Invalid request method.', 405);
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

if ($honeypot !== '') {
    fail_response('Spam detected.', 400);
}

if ($csrfToken === '' || $sessionCsrfToken === '' || !hash_equals($sessionCsrfToken, $csrfToken)) {
    fail_response('Security validation failed. Please refresh and try again.', 400);
}

/*
    |--------------------------------------------------------------------------
    | Rate limit
    |--------------------------------------------------------------------------
    */
$now = time();
$lastSubmit = (int) ($_SESSION['contact_last_submit'] ?? 0);

if (($now - $lastSubmit) < 15) {
    fail_response('Please wait a few seconds before sending another message.', 429);
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
    | reCAPTCHA v3 verification
    |--------------------------------------------------------------------------
    */
if (!defined('CONTACT_RECAPTCHA_SECRET_KEY') || CONTACT_RECAPTCHA_SECRET_KEY === '') {
    fail_response('reCAPTCHA secret key is missing.', 500);
}

if ($recaptchaToken === '') {
    fail_response('Security verification failed. Please try again.');
}

if ($recaptchaAction !== 'contact_form') {
    fail_response('Invalid security action.', 400);
}

$verifyPostData = http_build_query([
    'secret'   => CONTACT_RECAPTCHA_SECRET_KEY,
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
    error_log('reCAPTCHA curl error: ' . $curlError);
    fail_response('Unable to verify reCAPTCHA. Please try again later. cURL: ' . $curlError, 500);
}

if ($httpCode !== 200) {
    error_log('reCAPTCHA HTTP code: ' . (string) $httpCode . ' body: ' . (string) $verifyResult);
    fail_response('Unable to verify reCAPTCHA. HTTP code: ' . (string) $httpCode, 500);
}

$captchaData = json_decode((string) $verifyResult, true);

if (
    !is_array($captchaData) ||
    empty($captchaData['success']) ||
    (string) ($captchaData['action'] ?? '') !== 'contact_form' ||
    (float) ($captchaData['score'] ?? 0) < 0.5
) {
    fail_response('Security verification failed. Please try again.');
}

/*
    |--------------------------------------------------------------------------
    | Mail config validation
    |--------------------------------------------------------------------------
    */
if (
    !defined('SMTP_HOST') ||
    !defined('SMTP_PORT') ||
    !defined('SMTP_USERNAME') ||
    !defined('SMTP_PASSWORD') ||
    !defined('SMTP_FROM_EMAIL') ||
    !defined('SMTP_FROM_NAME') ||
    !defined('CONTACT_TO_EMAIL') ||
    !defined('CONTACT_TO_NAME')
) {
    fail_response('Mail configuration is incomplete.', 500);
}

/*
    |--------------------------------------------------------------------------
    | Send email
    |--------------------------------------------------------------------------
    */
try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->Port       = (int) SMTP_PORT;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
    $mail->addAddress(CONTACT_TO_EMAIL, CONTACT_TO_NAME);
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
    $body[] = 'reCAPTCHA score: ' . (string) ($captchaData['score'] ?? '');
    $body[] = '';
    $body[] = 'Message:';
    $body[] = $message;

    $mail->Body = implode(PHP_EOL, $body);

    /*
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        */

    $mail->send();

    $_SESSION['contact_last_submit'] = $now;
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

    exit('OK');
} catch (Exception $e) {
    error_log('Contact form mail error: ' . $e->getMessage());
    fail_response('Unable to send your message right now. Please try again later.', 500);
}
