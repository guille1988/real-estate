<?php

declare(strict_types=1);

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('', HomeController::class)
    ->name('home');

Route::get('about', AboutController::class)
    ->name('about');

Route::get('services', ServiceController::class)
    ->name('services');

Route::resource('contact', ContactController::class)
    ->only(['index', 'store']);

Route::resource('properties', PropertyController::class)
    ->only(['index', 'show', 'store']);
