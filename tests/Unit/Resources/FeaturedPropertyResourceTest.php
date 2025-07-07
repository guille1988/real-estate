<?php

declare(strict_types=1);

use App\Http\Resources\FeaturedPropertyResource;
use App\Models\Image;
use App\Models\Property;

it('works.', function (): void {
    Image::factory(10)
        ->default()
        ->create();

    expect(Property::all()->toResourceCollection(FeaturedPropertyResource::class))
        ->not->toBeEmpty();
})->todo('Finish this.');
