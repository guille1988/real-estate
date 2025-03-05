<?php

declare(strict_types=1);

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

Route::get('', HomeController::class)
    ->name('home');

Route::get('about', AboutController::class)
    ->name('about');

Route::get('contact', ContactController::class)
    ->name('contact');

Route::get('properties', PropertiesController::class)
    ->name('properties');

Route::get('services', ServicesController::class)
    ->name('services');
