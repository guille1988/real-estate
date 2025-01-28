<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as SymfonyNotFoundHttpException;
use Throwable;

final class Handler extends ExceptionHandler
{
    /**
     * $request type is ignored because
     * interface doesn't let me type it.
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response // @pest-ignore-type
    {
        if (is_null($exception = $this->bindings($e))) {
            return parent::render($request, $e);
        }

        throw new $exception;
    }

    /**
     * @return class-string<Throwable>|null
     */
    private function bindings(Throwable $exception): ?string
    {
        return match ($exception::class) {
            SymfonyNotFoundHttpException::class => NotFoundHttpException::class,
            default => null,
        };
    }
}
