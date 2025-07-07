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
    $image = Image::factory()
        ->create();

    expect($image->property->images)
        ->toHaveCount(1);
});

it('has a default image.', function (): void {
    $image = Image::factory()
        ->default()
        ->create();

    expect($image->property->defaultImage)
        ->not->toBeNull();
});
