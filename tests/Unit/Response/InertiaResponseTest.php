<?php

declare(strict_types=1);

namespace Tests\Unit\Response;

use App\Enums\PageEnum;
use App\Models\Property;
use App\Responses\InertiaResponse;
use Inertia\Response;
use InvalidArgumentException;

enum InertiaResponseTest
{
    case DASHBOARD;
}

it('works with collections and arrays.', function (bool $isArray): void {
    $properties = Property::all();

    if ($isArray) {
        $properties = $properties->toArray();
    }

    $inertiaResponse = app(InertiaResponse::class)
        ->render(PageEnum::HOME->value, $properties);

    expect($inertiaResponse)
        ->toBeInstanceOf(Response::class);
})->with([true, false]);

it('renders with a BackedEnum component.', function (): void {
    expect(app(InertiaResponse::class)->render(PageEnum::HOME))
        ->toBeInstanceOf(Response::class);
});

it('renders with a UnitEnum component.', function (): void {
    expect(app(InertiaResponse::class)->render(InertiaResponseTest::DASHBOARD))
        ->toBeInstanceOf(Response::class);
});

it('throws when component is not a string or BackedEnum.', function (): void {
    app(InertiaResponse::class)->render(123);
})->throws(InvalidArgumentException::class);
