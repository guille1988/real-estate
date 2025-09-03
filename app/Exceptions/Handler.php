<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Support\InertiaResponseHelper;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class Handler extends ExceptionHandler
{
    /**
     * $request type is ignored because
     * the interface doesn't let me type it.
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response // @pest-ignore-type
    {
        /*
         * First, we will check if the exception is a validation exception.
         * If it's not, we will let the parent class handle it.
         */
        if (! $e instanceof ValidationException) {
            return parent::render($request, $e);
        }

        /**
         * Second, we transform the errors into camel case.
         *
         * @var array<string, mixed> $errors
         */
        $errors = app()->call(
            InertiaResponseHelper::class,
            ['data' => $e->errors()],
        );

        // Third, if the request wants JSON, we will return a JSON response.
        if ($request->wantsJson()) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $errors,
            ], $e->status);
        }

        // At last, we will return a redirect with the errors.
        return back()
            ->withInput($request->except($this->dontFlash))
            ->withErrors($errors);
    }
}
