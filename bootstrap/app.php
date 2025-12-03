<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware alias
        $middleware->alias([
            'auth.check' => CheckAuth::class,
            'guest' => RedirectIfAuthenticated::class,
            'admin' => AdminMiddleware::class,
        ]);
        
        // Jika ingin menambahkan middleware ke semua web routes
        // $middleware->appendToGroup('web', [
        //     // Middleware yang akan ditambahkan ke semua web routes
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();