<?php

declare(strict_types=1);

namespace App\Providers;

use App\Exceptions\Handler;
use App\Responses\InertiaResponse;
use Carbon\CarbonImmutable;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Inertia\ResponseFactory;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Configure authentication redirect.
     */
    private function configureAuthenticationRedirect(): void
    {
        Authenticate::redirectUsing(fn (): string => route('admin.login'));
    }

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
     * Configure the application exception handler.
     */
    private function configureExceptionHandler(): void
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
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
     * Configure application's password validation.
     */
    private function configurePasswordValidation(): void
    {
        if ($this->app->isLocal()) {
            return;
        }

        Password::defaults(function (): ?Password {
            return Password::uncompromised()
                ->numbers()
                ->mixedCase()
                ->symbols()
                ->min(8)
                ->max(200);
        });
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

        RateLimiter::for('form', function (Request $request): Limit {
            return Limit::perSecond(1)
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
        $this->configureAuthenticationRedirect();
        $this->configureCommands();
        $this->configureDates();
        $this->configureExceptionHandler();
        $this->configureModels();
        $this->configurePasswordValidation();
        $this->configureRateLimiting();
        $this->configureResources();
        $this->configureUrl();
        $this->configureVite();
    }
}
