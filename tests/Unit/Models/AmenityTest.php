<?php

declare(strict_types=1);

use App\Models\Amenity;

it('contains all proper attributes.', function (): void {
    $amenity = Amenity::factory()
        ->create()
        ->fresh();

    expect(array_keys($amenity->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'description',
            'property_id',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(Amenity::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(Amenity::factory()->create()->uniqueIds())
        ->toContain('uuid');
});

it('has a property.', function (): void {
    expect(Amenity::factory()->create()->property)
        ->not->toBeNull();
});
