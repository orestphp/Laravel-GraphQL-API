## Environment
- PHP 8.1
- Laravel 9

## Installation
- remove `root/vendor` directory
- `composer install`
- configure `.env` connections to db
- `php artisan migrate:refresh --seed`

## After release
- `php artisan optimize:clear`
- `php artisan optimize`
- `php artisan lighthouse:clear-cache`
- `php artisan horizon:terminate` (not implemented yet)

## Ready users
- admin@admin.com / admini
- man@man.com / manager
