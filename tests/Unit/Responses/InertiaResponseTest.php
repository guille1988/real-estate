<?php

declare(strict_types=1);

use App\Models\Property;
use App\Responses\InertiaResponse;
use Inertia\Response;

it('works with collections and arrays.', function (bool $isArray): void {
    $properties = Property::all();

    if ($isArray) {
        $properties = $properties->toArray();
    }

    $inertiaResponse = app(InertiaResponse::class)
        ->render('Component', $properties);

    expect($inertiaResponse)
        ->toBeInstanceOf(Response::class);
})->with([true, false]);
