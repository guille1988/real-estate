<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\AssetHelper;
use App\Support\InertiaRequestHelper;
use App\Support\InertiaResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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

        $globalAssets = cache()
            ->rememberForever('global-assets', function (): array {

                /**
                 * @var array<string, string> $assets
                 */
                $assets = app()->call(AssetHelper::class, [
                    'asset' => 'real_estate_logo',
                ]);

                return $assets;
            });

        /**
         * @var array<string, mixed> $data
         */
        $data = [
            ...$sharedProperties,
            'global_assets' => fn (): array => $globalAssets,
            'auth' => [
                'user' => fn (): ?JsonResource => $request->user()?->toResource(),
            ],
        ];

        /**
         * @var array<int|string, mixed>
         */
        return app()->call(
            InertiaResponseHelper::class,
            compact('data'),
        );
    }

    /*
     * Handle the incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
            Replace all the data of the request
            for the snake case version of it.
        */
        if (count($data = $request->all()) > 0) {
            /**
             * @var array<int|string, mixed> $snakeCaseData
             */
            $snakeCaseData = app()->call(InertiaRequestHelper::class, compact('data'));

            $request->replace($snakeCaseData);
        }

        return parent::handle($request, $next);
    }
}
