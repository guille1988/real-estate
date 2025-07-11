<?php

declare(strict_types=1);

namespace App\Providers;

use App\Responses\InertiaResponse;
use Carbon\CarbonImmutable;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\ResponseFactory;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Configure commands.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands($this->app->isProduction());
    }

    /**
     * Configure dates.
     */
    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    /**
     * Configure Inertia response.
     */
    private function configureInertiaResponse(): void
    {
        $this->app->singleton(ResponseFactory::class, InertiaResponse::class);
    }

    /**
     * Configure models.
     */
    private function configureModels(): void
    {
        Model::shouldBeStrict(! $this->app->isProduction());
        Model::automaticallyEagerLoadRelationships();
        Model::unguard();
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('app', function (Request $request): Limit {
            return Limit::perSecond(20)
                ->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Configure resources.
     */
    private function configureResources(): void
    {
        JsonResource::withoutWrapping();
    }

    /**
     * Configure URL.
     */
    private function configureUrl(): void
    {
        URL::forceHttps($this->app->isProduction());
    }

    /**
     * Configure Vite loading strategy.
     */
    private function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->configureInertiaResponse();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureDates();
        $this->configureModels();
        $this->configureRateLimiting();
        $this->configureResources();
        $this->configureUrl();
        $this->configureVite();
    }
}
