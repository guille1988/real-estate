<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('', HomeController::class)
    ->name('home');

Route::get('properties', PropertyController::class)
    ->name('properties');
