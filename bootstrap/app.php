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
            'api-lang'     => \App\Http\Middleware\LangApiMiddleware::class,
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

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $responder = new class {
            use ApiResponder;
        };

        // ========================================================================
        // OBSERVABILITY: Log all exceptions with context
        // ========================================================================
        $exceptions->report(function (\Throwable $e) {
            // Add rich context to all exception logs
            $context = [
                'exception_id' => uniqid('exc_', true),
                'exception_class' => get_class($e),
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => collect($e->getTrace())->take(10)->map(function ($frame) {
                    return [
                        'file' => $frame['file'] ?? 'unknown',
                        'line' => $frame['line'] ?? 0,
                        'function' => ($frame['class'] ?? '').($frame['type'] ?? '').($frame['function'] ?? ''),
                    ];
                })->toArray(),
                'request' => [
                    'url' => request()->fullUrl(),
                    'method' => request()->method(),
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'user_id' => auth()->id(),
                ],
                'environment' => config('app.env'),
                'timestamp' => now()->toIso8601String(),
            ];

            \Illuminate\Support\Facades\Log::channel('single')->error(
                sprintf('[EXCEPTION] %s: %s in %s:%d',
                    class_basename($e),
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine()
                ),
                $context
            );
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) use ($responder) {
            if (! ($request->is('api/*') || $request->expectsJson())) {
                return null;
            }

            if ($e->getPrevious() && $e->getPrevious() instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return $responder
                    ->setStatusCode(404)
                    ->respondWithError('Model not found', 404);
            }

            return $responder
                ->setStatusCode(404)
                ->respondWithError('URL not found', 404);
        });

        $exceptions->render(function (\Illuminate\Auth\Access\AuthorizationException $exception, $request) use ($responder) {
            if (! ($request->is('api/*') || $request->expectsJson())) {
                return null;
            }

            return $responder
                ->setStatusCode(403)
                ->respondWithError('This action is unauthorized.', 403);
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $exception, $request) use ($responder) {
            if (! ($request->is('api/*') || $request->expectsJson())) {
                return null;
            }

            return $responder
                ->setStatusCode(403)
                ->respondWithError('This action is unauthorized.', 403);
        });

        $exceptions->render(function (\Illuminate\Validation\ValidationException $exception, $request) use ($responder) {
            if (! ($request->is('api/*') || $request->expectsJson())) {
                return null;
            }

            return $responder
                ->setStatusCode(422)
                ->respondWithError(array_values($exception->errors())[0][0], 422);
        });

        $exceptions->render(function (AuthenticationException $exception, $request) use ($responder) {
            if (! ($request->is('api/*') || $request->expectsJson())) {
                return null;
            }

            return $responder
                ->setStatusCode(401)
                ->respondWithError('You have to login first.', 401);
        });

        $exceptions->render(function (ThrottleRequestsException $exception, $request) use ($responder) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return $responder->setStatusCode($exception->getStatusCode())->respondWithError('Too many requests. Please try again later.', $exception->getStatusCode());
            }

            return redirect()->route('admin.login')->withErrors([
                'email' => 'Too many login attempts. Please try again in 1 minute.',
            ]);
        });
    })->create();
