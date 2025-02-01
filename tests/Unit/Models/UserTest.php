<?php

declare(strict_types=1);

use App\Models\User;

it('contains all proper attributes', function (): void {
    $user = User::factory()
        ->create()
        ->fresh();

    expect(array_keys($user->toArray()))
        ->toEqual([
            'id',
            'name',
            'email',
            'email_verified_at',
            'is_admin',
            'created_at',
            'updated_at',
        ]);
});

it('matches with admin condition.', function (): void {
    expect(($user = User::inRandomOrder()->first())->isAdmin())->toEqual($user->is_admin);
});
