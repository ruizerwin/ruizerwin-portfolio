<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'recaptcha' => [
        // Prefer RECAPTCHA_V3_*; fall back to legacy CONTACT_RECAPTCHA_*.
        // Use ?: so empty strings in .env still fall through.
        'site_key' => env('RECAPTCHA_V3_SITE_KEY') ?: env('CONTACT_RECAPTCHA_SITE_KEY', ''),
        'secret_key' => env('RECAPTCHA_V3_SECRET_KEY') ?: env('CONTACT_RECAPTCHA_SECRET_KEY', ''),
        'min_score' => (float) env('RECAPTCHA_V3_MIN_SCORE', 0.5),
    ],

];
