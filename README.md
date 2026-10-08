# King Castle School Muhammad Campus — Backend API

Production-oriented Laravel + PostgreSQL REST backend for Android/Web clients.

## Requirements
- PHP 8.2+
- Composer 2+
- PostgreSQL 14+

## Install
1. `composer install`
2. `cp .env.example .env` (Windows: copy `.env.example` `.env`)
3. Configure PostgreSQL in `.env`.
4. `php artisan key:generate`
5. `php artisan jwt:secret`
6. `php artisan migrate --seed`
7. `php artisan storage:link`
8. `php artisan serve`

API base: `http://127.0.0.1:8000/api/v1`

## Seed accounts
- superadmin1@kcs.school / password123
- admin@kcs.school / password123
- teacher@kcs.school / password123

Change these credentials before production deployment.

## Documentation
- OpenAPI: `docs/openapi.yaml`
- Postman: `docs/postman_collection.json`

## Security
JWT is required for protected endpoints. Tenant isolation is enforced using `school_id`. Production should use HTTPS, a restricted CORS origin, secure secrets and a managed PostgreSQL database.

## Tests
`php artisan test`

## Notes
The AI assistant is intentionally provider-agnostic. Its database queries remain subject to the authenticated user's role. Real-time messaging can be layered on the existing messages table using Laravel broadcasting/WebSockets.
