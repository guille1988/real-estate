<?php

declare(strict_types=1);

use App\Models\PropertyMessage;

it('contains all proper attributes.', function (): void {
    $amenity = PropertyMessage::factory()
        ->create()
        ->fresh();

    expect(array_keys($amenity->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'first_name',
            'last_name',
            'email',
            'phone',
            'location',
            'property_type',
            'budget',
            'bedrooms',
            'bathrooms',
            'message',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(PropertyMessage::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(PropertyMessage::factory()->create()->uniqueIds())
        ->toContain('uuid');
});
