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