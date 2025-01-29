<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Inertia\Response;
use Inertia\ResponseFactory;

Route::get('/', function (): Response|ResponseFactory {
    return inertia('Home');
})->name('home');
