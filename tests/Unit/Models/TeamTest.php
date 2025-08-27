<?php

declare(strict_types=1);

use App\Models\Team;

it('contains all proper attributes.', function (): void {
    $team = Team::factory()
        ->create()
        ->fresh();

    expect(array_keys($team->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'name',
            'position',
            'thumbnail',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(Team::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(Team::factory()->create()->uniqueIds())
        ->toContain('uuid');
});

it('gets thumbnail URL as expected.', function (): void {
    expect(Team::factory()->create()->getUrl())
        ->toBeUrl();
});
