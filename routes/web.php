<?php

declare(strict_types=1);

use App\Http\Controllers\AboutController;
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
            ->name('.messages');
    });

Route::prefix('properties')
    ->name('properties')
    ->group(function (): void {
        Route::get('', [PropertyController::class, 'index'])
            ->name('.index');

        Route::get('{property}', [PropertyController::class, 'show'])
            ->name('.show');

        Route::post('inquiries', [PropertyController::class, 'inquire'])
            ->name('.inquiries');

        Route::post('messages', PropertyMessageController::class)
            ->name('.messages');
    });

Route::post('subscribers', SubscriberController::class)
    ->name('subscribers');
