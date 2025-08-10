<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\InertiaRequestHelper;
use App\Support\InertiaResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Symfony\Component\HttpFoundation\Response;
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
        return app()
            ->call(InertiaResponseHelper::class, compact('data'));
    }

    /*
     * Handle the incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
            Replace all the query strings of the
            request for the snake case version.
        */
        if ($request->query->count() > 0) {
            /**
             * @var array<int|string, mixed> $snakeCaseQueryStrings
             */
            $snakeCaseQueryStrings = app()
                ->call(InertiaRequestHelper::class, [
                    'data' => $request->query->all(),
                ]);

            $request->query->replace($snakeCaseQueryStrings);
        }

        /*
            Replace all the JSON payload of the
            request for the snake case version.
        */
        if ($request->json()->count() > 0) {

            /**
             * @var array<int|string, mixed> $jsonPayload
             */
            $jsonPayload = app()->call(InertiaRequestHelper::class, [
                'data' => $request->json()->all(),
            ]);

            $request->json()->replace($jsonPayload);
        }

        return parent::handle($request, $next);
    }
}
