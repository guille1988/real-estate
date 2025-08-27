<?php

declare(strict_types=1);

use App\Models\Client;

it('contains all proper attributes.', function (): void {
    $client = Client::factory()
        ->create()
        ->fresh();

    expect(array_keys($client->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'since',
            'url',
            'company',
            'domain',
            'category',
            'opinion',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(Client::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(Client::factory()->create()->uniqueIds())
        ->toContain('uuid');
});
