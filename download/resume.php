<?php

declare(strict_types=1);

$projectRoot = dirname(__DIR__);

require $projectRoot . '/includes/helpers/functions.php';
require $projectRoot . '/includes/boot.php';

$resumeFile = $projectRoot . '/' . RESUME_PDF_FILE;

if (!is_file($resumeFile)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=UTF-8');
    exit('Resume file is not available.');
}

$filename = 'Erwin_Padilla_Resume.pdf';
$fileSize = filesize($resumeFile);

if ($fileSize === false) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    exit('Unable to read resume file.');
}

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . (string) $fileSize);
header('Cache-Control: private, max-age=3600');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

if (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
) {
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
}

if (ob_get_level() > 0) {
    ob_end_clean();
}

readfile($resumeFile);
exit;
