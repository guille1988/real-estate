<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class TestController
{
    public function __construct()
    {
        Gate::denyIf(app()->isProduction());
    }

    public function __invoke(): JsonResponse
    {
        return response()->json('Ok');
    }
}
