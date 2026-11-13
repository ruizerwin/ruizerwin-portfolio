# ruizerwin.com

Laravel 13 portfolio for Erwin D. Padilla.

`APP_NAME` is `ruizerwin`. The folder/domain can stay `ruizerwin.com` (Laragon/AWS). No rename required.

## Local development (Laragon)

1. Apache **DocumentRoot must be** `...\ruizerwin.com\public` (already set in Laragon vhost).
2. In Laragon: **Stop** then **Start All** (or Apache → Reload) after vhost changes.
3. Open http://ruizerwin.com.test

Or without Apache:

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan serve
```

## Environment files

| File | Purpose | Commit? |
|---|---|---|
| `.env` | Your real local secrets | **Never** |
| `.env.example` | Local template | Yes |
| `.env.staging.example` | Staging template | Yes |
| `.env.production.example` | Production template | Yes |
| Server `/var/www/staging/.env` | Real staging secrets | Server only |
| Server `/var/www/ruizerwin.com/.env` | Real production secrets | Server only |

On each server: copy the matching `*.example` → `.env`, set `APP_KEY`, mail, and reCAPTCHA.

## Security

- Never commit `vendor/`, `node_modules/`, or `.env*` secrets.
- Web root is only `public/`.
- Root `.htaccess` blocks sensitive paths if DocumentRoot is misconfigured.
