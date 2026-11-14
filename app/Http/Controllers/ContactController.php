<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Throwable;

class ContactController extends Controller
{
    /**
     * Handle the portfolio contact form submission.
     */
    public function store(Request $request): JsonResponse
    {
        // Soft rate limit: one successful attempt window per IP.
        $rateKey = 'contact-form:' . $request->ip();

        if (RateLimiter::tooManyAttempts($rateKey, 1)) {
            return response()->json([
                'message' => 'Please wait a few seconds before sending another message.',
            ], 429);
        }

        // Honeypot: bots often fill hidden fields.
        if (filled($request->input('company_website'))) {
            return response()->json([
                'message' => 'Unable to send your message. Please try again.',
            ], 400);
        }

        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'min:2', 'max:100'],
                'email' => ['required', 'email', 'max:150'],
                'subject' => ['required', 'string', 'min:3', 'max:150'],
                'message' => ['required', 'string', 'min:10', 'max:3000'],
                'g-recaptcha-response' => ['nullable', 'string'],
                'recaptcha_action' => ['nullable', 'string'],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => collect($e->errors())->flatten()->first() ?: 'Please check the form and try again.',
            ], 422);
        }

        $siteKey = trim((string) config('services.recaptcha.site_key', ''));
        $secret = trim((string) config('services.recaptcha.secret_key', ''));
        $minScore = (float) config('services.recaptcha.min_score', 0.5);

        // If either key is configured, require a complete reCAPTCHA v3 check.
        if ($siteKey !== '' || $secret !== '') {
            if ($siteKey === '' || $secret === '') {
                report(new \RuntimeException('reCAPTCHA is partially configured. Set both RECAPTCHA_V3_SITE_KEY and RECAPTCHA_V3_SECRET_KEY.'));

                return response()->json([
                    'message' => 'Unable to send your message right now. Please try again later.',
                ], 500);
            }

            $token = (string) ($data['g-recaptcha-response'] ?? '');
            $action = (string) ($data['recaptcha_action'] ?? '');

            if ($token === '' || $action !== 'contact_form') {
                return response()->json([
                    'message' => 'Security verification failed. Please refresh the page and try again.',
                ], 400);
            }

            $verify = Http::asForm()->timeout(15)->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $request->ip(),
            ]);

            if (! $verify->ok()) {
                return response()->json([
                    'message' => 'Unable to verify your submission. Please try again later.',
                ], 500);
            }

            $captcha = $verify->json();
            $score = (float) ($captcha['score'] ?? 0);

            if (
                empty($captcha['success'])
                || (($captcha['action'] ?? '') !== 'contact_form')
                || $score < $minScore
            ) {
                return response()->json([
                    'message' => 'Security verification failed. Please try again.',
                ], 400);
            }

            $data['recaptcha_score'] = (string) $score;
        }

        $data['ip'] = (string) $request->ip();

        try {
            Mail::to(
                (string) config('mail.contact_inbox_address'),
                (string) config('mail.contact_inbox_name')
            )->send(new ContactMessageMail($data));
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'Unable to send your message right now. Please try again later.',
            ], 500);
        }

        RateLimiter::hit($rateKey, 15);

        return response()->json([
            'message' => 'OK',
        ]);
    }
}
