<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
         $middleware->alias([
            'subscription' => \App\Http\Middleware\CheckSubscription::class,
            'isSuperAdmin' => \App\Http\Middleware\IsSuperAdmin::class,
        ]);
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    // ->withProviders([
    //     EMedia\MultiTenant\MultiTenantServiceProvider::class,
    // ])
    ->create();
return $app;
