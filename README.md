# ruizerwin.com

Laravel 13 portfolio for Erwin D. Padilla.

## Local (Laragon)

1. DocumentRoot must be `...\ruizerwin.com\public`
2. `composer install` (if needed)
3. Copy `.env.example` → `.env` and run `php artisan key:generate`
4. Open http://ruizerwin.com.test  
   Or: `php artisan serve` → http://127.0.0.1:8000

## Env templates

| File | Use |
|---|---|
| `.env.example` | Local |
| `.env.staging.example` | Staging server |
| `.env.production.example` | Production server |

Never commit real `.env` files. Put Zoho SMTP + reCAPTCHA on **both** staging and production.
