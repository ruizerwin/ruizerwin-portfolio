# ruizerwin.com

Laravel portfolio site.

## Local setup

1. DocumentRoot = `public/`
2. `composer install`
3. Create a local `.env` on your machine (never commit it)
4. `php artisan key:generate`
5. Open the local site URL

## Deploy / servers

- Real `.env` files live only on each server (`/var/www/staging`, `/var/www/ruizerwin.com`)
- Nothing under `.env*` is tracked in git
- Deploy fails if the server `.env` is missing (it will not create one from git)
