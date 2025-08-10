<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class TransformKeysToSnakeCaseMiddleware
{
    /**
     * Recursively transform array keys to snake case.
     *
     * @param  array<int|string, mixed>  $data
     * @return array<int|string, mixed>
     */
    private function transformKeysToSnakeCase(array $data): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            if (is_string($key)) {
                $key = str($key)
                    ->snake()
                    ->toString();
            }

            $result[$key] = is_array($value)
                ? $this->transformKeysToSnakeCase($value)
                : $value;
        }

        return $result;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        /*
            Replace all the query strings of the
            request for the snake case version.
        */
        if ($request->query->count() > 0) {
            $request->query->replace(
                $this->transformKeysToSnakeCase($request->query->all())
            );
        }

        /*
            Replace all the JSON payload of the
            request for the snake case version.
        */
        if ($request->json()->count() > 0) {
            $request->json()->replace(
                $this->transformKeysToSnakeCase($request->json()->all())
            );
        }

        return $next($request);
    }
}
