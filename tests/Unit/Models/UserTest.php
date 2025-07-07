<?php

declare(strict_types=1);

use App\Models\User;

it('contains all proper attributes.', function (): void {
    $user = User::factory()
        ->create()
        ->fresh();

    expect(array_keys($user->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'name',
            'email',
            'email_verified_at',
            'is_admin',
            'created_at',
            'updated_at',
        ]);
});

it('matches with admin condition.', function (): void {
    expect(($user = User::factory()->create())->isAdmin())
        ->toEqual($user->is_admin);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(User::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(User::factory()->create()->uniqueIds())
        ->toContain('uuid');
});
