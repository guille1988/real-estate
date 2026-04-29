<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class ClearInertiaHistoryMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        Inertia::clearHistory();

        return $next($request);
    }
}
