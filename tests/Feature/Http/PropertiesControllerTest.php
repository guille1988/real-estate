<?php

declare(strict_types=1);

use App\Models\Amenity;
use App\Models\Image;
use App\Models\Property;

it('works indexing properties.', function (): void {
    $this->get(route('properties.index'))
        ->assertOk();
});

it('works showing a specific property.', function (): void {
    $property = Property::factory()
        ->create();

    Image::factory()
        ->default()
        ->create(['property_id' => $property->id]);

    Image::factory(8)
        ->create(['property_id' => $property->id]);

    Amenity::factory(8)
        ->create(['property_id' => $property->id]);

    $this->get(route('properties.show', $property->uuid))
        ->assertOk();
});
