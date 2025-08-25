<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Http\Middleware\HandleInertiaRequestMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            'throttle:app',
            HandleInertiaRequestMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function (Response $response, Throwable $exception, Request $request): Response {
            /**
             * @var int[] $statusCodes
             */
            $statusCodes = [
                Response::HTTP_FORBIDDEN,
                Response::HTTP_NOT_FOUND,
                Response::HTTP_INTERNAL_SERVER_ERROR,
                Response::HTTP_SERVICE_UNAVAILABLE,
            ];

            $statusCode = $response->getStatusCode();

            if (app()->isProduction() && in_array($statusCode, $statusCodes)) {
                return Inertia::render(PageEnum::ERROR->value, ['status_code' => $statusCode])
                    ->toResponse($request)
                    ->setStatusCode($statusCode);
            }

            // 419 is not present inside Symfony HTTP error codes.
            if ($statusCode === 419) {
                return back()->with([
                    'message' => 'The page expired, please try again.',
                ]);
            }

            return $response;
        });
    })->create();
