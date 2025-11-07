<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // <-- TAMBAHKAN INI JIKA BELUM ADA

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // --- TAMBAHKAN BLOK INI ---
        // Ini memberitahu middleware 'auth' untuk 
        // me-redirect ke 'admin.login' jika pengguna belum login
        $middleware->redirectTo(
            fn(Request $request) => $request->expectsJson() ? null : route('admin.login')
        );
        // --- AKHIR BLOK ---

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
