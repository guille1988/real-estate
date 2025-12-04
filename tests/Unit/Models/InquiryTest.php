<?php

declare(strict_types=1);

use App\Models\Inquiry;

it('contains all proper attributes.', function (): void {
    $inquiry = Inquiry::factory()
        ->create()
        ->fresh();

    expect(array_keys($inquiry->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'first_name',
            'last_name',
            'email',
            'phone',
            'message',
            'read_at',
            'property_id',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(Inquiry::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(Inquiry::factory()->create()->uniqueIds())
        ->toContain('uuid');
});

it('has an property.', function (): void {
    expect(Inquiry::factory()->create()->property)
        ->not->toBeNull();
});
