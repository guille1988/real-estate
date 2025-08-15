<?php

declare(strict_types=1);

use App\Models\Image;

it('contains all proper attributes.', function (): void {
    $image = Image::factory()
        ->create()
        ->fresh();

    expect(array_keys($image->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'path',
            'is_default',
            'property_id',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(Image::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(Image::factory()->create()->uniqueIds())
        ->toContain('uuid');
});

it('gets image URL as expected.', function (): void {
    expect(Image::factory()->create()->getUrl())
        ->toBeUrl();
});

it('has a property.', function (): void {
    expect(Image::factory()->create()->property)
        ->not->toBeNull();
});
