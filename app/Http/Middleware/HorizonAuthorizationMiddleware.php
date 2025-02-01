<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class HorizonAuthorizationMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        auth()->onceBasic();

        abort_unless(
            (bool) auth()->user()?->isAdmin(),
            Response::HTTP_UNAUTHORIZED,
            'Unauthorized.'
        );

        return $next($request);
    }
}
