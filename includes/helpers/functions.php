<?php
    /**
     * Safe HTML escape (XSS protection)
     * - Accepts null, int, string
     * - Never throws warnings
     */
    function e(mixed $value): string
    {
        if ($value === null) {
            return '';
        }

        // Prevent arrays/objects from breaking htmlspecialchars
        if (is_array($value) || is_object($value)) {
            return '';
        }

        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    function et(mixed $value): string
    {
        return e(t($value));
    }

    function t(mixed $value): string
    {
        if ($value === null) {
            return '';
        }

        if (is_array($value) || is_object($value)) {
            return '';
        }

        return trim((string)$value);
    }

    function ea(mixed $value): string
    {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    function linkedin_url(): string
    {
        return defined('LINKEDIN_URL') ? (string) LINKEDIN_URL : 'https://www.linkedin.com/in/ruizerwin/';
    }

    function resume_pdf_url(): string
    {
        $path = '/download/resume.php';
        $base = defined('APP_URL') ? rtrim((string) APP_URL, '/') : '';

        if ($base !== '') {
            if (str_starts_with($base, 'http://')) {
                $base = 'https://' . substr($base, 7);
            }

            return $base . $path;
        }

        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

        if ($isHttps) {
            $host = $_SERVER['HTTP_HOST'] ?? 'ruizerwin.com';

            return 'https://' . $host . $path;
        }

        return $path;
    }

    function resume_pdf_available(): bool
    {
        return defined('RESUME_PDF_AVAILABLE') && RESUME_PDF_AVAILABLE;
    }