<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use App\Traits\ApiResponder;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->alias([
            'ability'      => CheckForAnyAbility::class,
            'student.full' => \App\Http\Middleware\GuestMiddleware::class,
        ]);
        // $middleware->alias([
        //     'localization' => SetLocale::class
        // ]);
        $middleware->web(append: [
            SetLocale::class
        ]);
        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('api/*')) {
                return null;
            }
            return route('admin.login');
        });
                $middleware->alias([
            'api-lang'=>\App\Http\Middleware\LangApiMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $responder = new class {
            use ApiResponder;
        };
        $exceptions->render(function (AuthenticationException $exception, $request) use ($responder) {
            if ($request->is('api/*')) {
                return $responder->setStatusCode(401)->respondWithError(message: $exception->getMessage());
            }
        });
        $exceptions->render(function (ThrottleRequestsException $exception, $request) use ($responder) {
            if ($request->is('api/*')) {
                return  $responder->setStatusCode($exception->getStatusCode())->respondWithError(message: 'Too many requests. Please try again later.');
            }

            return redirect()->route('admin.login')->withErrors([
                'email' => 'Too many login attempts. Please try again in 1 minute.',
            ]);
        });
    })->create();
