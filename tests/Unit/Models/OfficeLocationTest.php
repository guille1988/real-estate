<?php

declare(strict_types=1);

use App\Models\OfficeLocation;

it('contains all proper attributes.', function (): void {
    $officeLocation = OfficeLocation::factory()
        ->create()
        ->fresh();

    expect(array_keys($officeLocation->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'email',
            'type',
            'title',
            'address',
            'description',
            'phone',
            'location',
            'url',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(OfficeLocation::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(OfficeLocation::factory()->create()->uniqueIds())
        ->toContain('uuid');
});
