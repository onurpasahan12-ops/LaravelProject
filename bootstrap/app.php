<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 'admin' takma adıyla yazdığımız middleware'i sisteme kaydediyoruz
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]); // <--- Burada parantezi ve noktalı virgülü doğru şekilde kapattık
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
