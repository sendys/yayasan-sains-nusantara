## Purpose

Help AI coding agents be productive in this Laravel 12 codebase. The file is concise and focused on discoverable, repo-specific patterns, workflows, and examples an agent should follow.

## Quick facts

-   Framework: Laravel ^12 (PHP ^8.2)
-   Frontend: Vite, Tailwind, Bootstrap (see `package.json`, `vite.config.js`)
-   Key packages: `spatie/laravel-permission`, `livewire/livewire`, `laravel/socialite` (see `composer.json`)

## Essential workflows (commands)

-   Install: `composer install` then `npm install`
-   Dev (local): `npm run dev` or use `composer dev` which runs `php artisan serve`, queue listener and Vite concurrently (see `composer.json` scripts)
-   Generate key / migrations (first-run): `php artisan key:generate` and `php artisan migrate`
-   Tests: `php artisan test` or `vendor/bin/phpunit` (configuration in `phpunit.xml`)

## Architecture & important files

-   Routes: `routes/web.php` — note explicit comments and ordering rules (static routes before dynamic routes; bulk-import/trashed routes placed before dynamic `{id}`/`{uuid}` routes).
-   Service bindings: `app/Providers/AppServiceProvider.php` — repository interfaces are bound here (look up `app/Repositories/*` for implementations).
-   Controllers: `app/Http/Controllers/*` (standard Laravel controllers; many use UUID route params and resource-like patterns).
-   Models: `app/Models/*` and Eloquent conventions are used throughout.
-   Views: `resources/views/*`; Blade templates are used for emails and UI (see README for email templates).

## Project-specific patterns and conventions (do not deviate)

-   Repository pattern: interfaces live under `app/Repositories/*/*Interface.php` and implementations follow `*Repositories.php`. Bindings occur in `AppServiceProvider`; register new bindings there.
-   Route ordering: preserve the explicit ordering in `routes/web.php` (static & bulk-import routes must appear before dynamic `{param}` routes). See `brand` prefix example in `routes/web.php`.
-   Throttles & rate-limiter names: registration throttling uses limiter `registration` (configured in `AppServiceProvider::boot`) and applied via `->middleware('throttle:registration')`; reuse these names when adding routes that must be limited.
-   Middleware: there are project-specific middleware names such as `check.activation` and `check.license`; enforce these where appropriate (see routes grouped middleware usage).
-   Google OAuth & activation flow: login/registration via Google uses routes `/auth/google`, `/auth/google/callback`, `/auth/google/complete` and an activation flow (see README.md content). Env vars: `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT_URI`.
-   Background/queues: the dev `composer dev` script runs `php artisan queue:listen` and `php artisan pail` — be careful when editing queue jobs; tests expect `QUEUE_CONNECTION=sync` in CI/test config.

## Testing notes

-   `phpunit.xml` sets many env overrides for testing (array cache/session, sync queue, mail array). Prefer using `php artisan test` which respects this config.
-   Unit tests live in `tests/Unit`, feature tests in `tests/Feature`.

## Integration & external dependencies

-   External services: Google OAuth (Socialite) and SMTP for activation emails. Credentials live in `.env` (do not attempt to hard-code secrets).
-   Permissioning: `spatie/laravel-permission` is used; follow existing role/permission conventions when creating gates.

## When editing code — small checklist for agents

1. Preserve repository bindings in `AppServiceProvider` when adding new repo interfaces/implementations.
2. Keep route ordering: add static/bulk routes before dynamic ones.
3. Use existing rate-limiter names and middleware for consistency (`registration`, `login`, `check.activation`, `check.license`).
4. Run migrations and `php artisan config:clear` if you change env-driven behavior.
5. Run `php artisan test` after substantive changes and ensure `QUEUE_CONNECTION=sync` for CI-like behavior.

## Where to look for examples

-   Repository binding example: `app/Providers/AppServiceProvider.php`
-   Route ordering & OAuth example: `routes/web.php` and `app/Http/Controllers/UserController.php` (Google flow)
-   Dev script orchestration: `composer.json` -> `scripts.dev`
-   Testing env choices: `phpunit.xml`

If any part of this file seems unclear or you want more detail for a specific area (repositories, a controller, or the OAuth flow), tell me which area and I'll expand the instructions with concrete code examples.
