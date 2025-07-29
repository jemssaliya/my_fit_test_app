# Device-Authentication Handling Package for Laravel 5

This adds OAuth2 based device authentication handling capability to API
developed with Laravel. This package depends on [Laravel Passport](https://github.com/laravel/passport) to support OAuth2.


## How to Install

Add the private repository in your `composer.json` file, and run `composer update`

```
	"repositories": [
        {
            "type":"git",
            "url":"https://bitbucket.org/elegantmedia/deviceauthentication-laravel.git"
        }
    ]
```
Add the repository to the required list on composer.json
`composer require emedia/deviceauthentication:dev-oauth2`

In `config\app.php`, add the service provider and the Facade.
Add to the list of providers:
`EMedia\DeviceAuthentication\DeviceAuthenticationServiceProvider::class`

Add to the list of aliases:
`'DeviceAuthentication' => EMedia\DeviceAuthentication\Facades\DeviceAuthentication::class,`

### Migrations

Currently the tokens are stored in the database, you will need to run the migrations

`php artisan migrate --path=vendor/emedia/deviceauthentication/src/migrations`


## How to Run

After installation, you can get, set, validate and discard the token at any point of the application.

```
	Authentication::getToken($device_id);
    Authentication::setToken($device_id);
    Authentication::validateToken($token);
    Authentication::discardToken($device_id,$token=0);
```

Use device authentication to validate token as a middle-ware, add below line to kernel.php

`\EMedia\DeviceAuthentication\Middleware\DeviceAuth::class,`
