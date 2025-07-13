<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\ArrayHelper;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Throwable;

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
     * @return array<int|string, mixed>
     *
     * @throws Throwable
     */
    public function share(Request $request): array
    {
        /** @var array<string, mixed> $sharedProperties */
        $sharedProperties = parent::share($request);

        /**
         * @var array<string, mixed> $data
         */
        $data = [
            ...$sharedProperties,
            'auth' => [
                'user' => $request->user()?->only([
                    'uuid',
                    'name',
                    'email',
                    'email_verified_at',
                ]),
            ],
        ];

        /**
         * @var array<int|string, mixed>
         */
        return ArrayHelper::transformKeysToCamelCase($data);
    }
}
