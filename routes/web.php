<?php

declare(strict_types=1);

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PricingDetailController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyMessageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::get('', HomeController::class)
    ->name('home');

Route::get('about', AboutController::class)
    ->name('about');

Route::get('services', ServiceController::class)
    ->name('services');

Route::prefix('contact')
    ->name('contact')
    ->group(function (): void {
        Route::get('', ContactController::class);

        Route::post('messages', ContactMessageController::class)
            ->name('.messages')
            ->middleware('throttle:form');
    });

Route::prefix('properties')
    ->name('properties')
    ->group(function (): void {
        Route::controller(PropertyController::class)
            ->group(function (): void {
                Route::get('', 'index')
                    ->name('.index');

                Route::get('{property}', 'show')
                    ->name('.show');

                Route::post('inquiries', 'inquire')
                    ->name('.inquiries')
                    ->middleware('throttle:form');
            });

        Route::post('messages', PropertyMessageController::class)
            ->name('.messages')
            ->middleware('throttle:form');
    });

Route::post('subscribers', SubscriberController::class)
    ->name('subscribers');

Route::prefix('admin')
    ->name('admin')
    ->group(function (): void {
        Route::get('', AdminController::class);

        Route::controller(LoginController::class)
            ->prefix('login')
            ->name('.login')
            ->group(function (): void {
                Route::get('', 'create')
                    ->name('.create');

                Route::post('', 'store')
                    ->name('.store')
                    ->middleware('throttle:form');

                Route::delete('', 'destroy')
                    ->name('.destroy');
            });

        Route::controller(ProfileController::class)
            ->prefix('profile')
            ->name('.profile')
            ->group(function (): void {
                Route::get('', 'edit')
                    ->name('.edit');

                Route::patch('', 'update')
                    ->name('.update');
            });

        Route::middleware('auth:web')
            ->group(function (): void {
                Route::get('dashboard', DashboardController::class)
                    ->name('.dashboard');

                Route::resource('properties', AdminPropertyController::class)
                    ->names([
                        'index' => '.properties.index',
                        'create' => '.properties.create',
                        'edit' => '.properties.edit',
                        'show' => '.properties.show',
                        'store' => '.properties.store',
                        'update' => '.properties.update',
                        'destroy' => '.properties.destroy',
                    ]);

                Route::post('properties/bulk-delete', [AdminPropertyController::class, 'bulkDestroy'])
                    ->name('.properties.bulk-delete');

                Route::resource('images', ImageController::class)
                    ->only(['index', 'create', 'edit', 'store', 'destroy'])
                    ->names([
                        'index' => '.images.index',
                        'create' => '.images.create',
                        'edit' => '.images.edit',
                        'store' => '.images.store',
                        'destroy' => '.images.destroy',
                    ]);

                Route::post('images/bulk-delete', [ImageController::class, 'bulkDestroy'])
                    ->name('.images.bulk-delete');

                Route::resource('pricing-details', PricingDetailController::class)
                    ->names([
                        'index' => '.pricing-details.index',
                        'create' => '.pricing-details.create',
                        'store' => '.pricing-details.store',
                        'show' => '.pricing-details.show',
                        'edit' => '.pricing-details.edit',
                        'update' => '.pricing-details.update',
                        'destroy' => '.pricing-details.destroy',
                    ]);

                Route::post('pricing-details/bulk-delete', [PricingDetailController::class, 'bulkDestroy'])
                    ->name('.pricing-details.bulk-delete');

                Route::resource('amenities', AmenityController::class)
                    ->names([
                        'index' => '.amenities.index',
                        'create' => '.amenities.create',
                        'show' => '.amenities.show',
                        'edit' => '.amenities.edit',
                        'store' => '.amenities.store',
                        'update' => '.amenities.update',
                        'destroy' => '.amenities.destroy',
                    ]);

                Route::post('amenities/bulk-delete', [AmenityController::class, 'bulkDestroy'])
                    ->name('.amenities.bulk-delete');
            });
    });
