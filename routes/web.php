<?php

declare(strict_types=1);

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TermsOfUseController;
use Illuminate\Support\Facades\Route;

Route::get('', HomeController::class)
    ->name('home');

Route::get('about', AboutController::class)
    ->name('about');

Route::get('contact', ContactController::class)
    ->name('contact');

Route::get('services', ServiceController::class)
    ->name('services');

Route::resource('properties', PropertyController::class)
    ->only(['index', 'show']);

Route::get('terms-of-use', TermsOfUseController::class)
    ->name('terms-of-use');

Route::get('privacy-policy', PrivacyPolicyController::class)
    ->name('privacy-policy');
