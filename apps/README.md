# Portfolio 2.0 apps

## Current production site
The live portfolio still runs from the **repository root** (`index.php`, `pages/`, `includes/`).

## Laravel 13 (parallel, not live yet)
Path: `apps/web`

This is the Portfolio 2.0 Laravel application. It does **not** replace the current site until we intentionally cut over.

### Run locally
```bash
cd apps/web
php artisan serve
```
Then open http://127.0.0.1:8000

### Notes
- Keep developing the public site at the repo root until migration phases are approved.
- Do not point AWS/Apache document root at `apps/web/public` until staging cutover is approved.
- `apps/web/.env` is local-only and must never be committed.
