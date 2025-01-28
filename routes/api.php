<?php

declare(strict_types=1);

use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;

Route::get('test', TestController::class)
    ->middleware('throttle:api')
    ->name('test');
