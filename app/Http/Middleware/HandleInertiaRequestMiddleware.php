<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

final class HandleInertiaRequestMiddleware extends Middleware
{
    /**
     * The root template loaded on the first page visited.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        /** @var array<string, mixed> $sharedProperties */
        $sharedProperties = parent::share($request);

        return [
            ...$sharedProperties,
            'auth' => [
                'user' => $request->user(),
            ],
        ];
    }
}
