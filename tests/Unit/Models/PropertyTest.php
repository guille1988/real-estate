<?php

declare(strict_types=1);

use App\Models\Image;
use App\Models\Property;

it('contains all proper attributes.', function (): void {
    $property = Property::factory()
        ->create()
        ->fresh();

    expect(array_keys($property->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'caption',
            'title',
            'description',
            'address',
            'type',
            'bathrooms',
            'bedrooms',
            'area',
            'price',
            'is_featured',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(Property::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(Property::factory()->create()->uniqueIds())
        ->toContain('uuid');
});

it('has images.', function (): void {
    $count = 4;

    $property = Property::factory()
        ->create();

    Image::factory($count)
        ->create(['property_id' => $property->id]);

    expect($property->fresh()->images)
        ->toHaveCount($count);
});

it('has a default image.', function (): void {
    $property = Property::factory()
        ->create();

    $image = Image::factory()
        ->default()
        ->create(['property_id' => $property->id]);

    expect($property->fresh()->defaultImage->id)
        ->toBe($image->id);
});

it('has the correct dollar price.', function (): void {
    expect(Property::factory()->create()->getDollarPrice())
        ->toBeString();
});
