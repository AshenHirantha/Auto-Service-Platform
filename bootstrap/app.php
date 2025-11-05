<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserTypeAccess;
use App\Http\Middleware\RedirectBasedOnUserType;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withProviders([
        \App\Providers\FilamentServiceProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware) {
                // Register your custom middleware aliases here
        $middleware->alias([
            'user.type' => \App\Http\Middleware\EnsureUserTypeAccess::class,
            'redirect.user' => \App\Http\Middleware\RedirectBasedOnUserType::class,
        ]);
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
