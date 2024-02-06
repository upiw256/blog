## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Install

Rekomendasi database menggunakan Mysql dari aiven

```console
composer install
npm install
php artisan migrate
php artisan make:filament-user
php artisan storage:link
```

## Pada AppServiceProvider.php

```php
use Illuminate\Support\Facades\Schema;
Schema::defaultStringLength(191);
```

## .env

```env
APP_URL_API=http://192.168.5.163:3001/api/
```
