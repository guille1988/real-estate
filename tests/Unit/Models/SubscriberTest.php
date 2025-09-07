<?php

declare(strict_types=1);

use App\Models\Subscriber;

it('contains all proper attributes.', function (): void {
    $subscriber = Subscriber::factory()
        ->create()
        ->fresh();

    expect(array_keys($subscriber->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'email',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(Subscriber::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(Subscriber::factory()->create()->uniqueIds())
        ->toContain('uuid');
});
