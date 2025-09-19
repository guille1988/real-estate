<?php

declare(strict_types=1);

use App\Models\User;

it("doesn't allow unregistered users to enter horizon dashboard.", function (): void {
    $this->get(route('horizon.index'))
        ->assertUnauthorized();
});

it("doesn't allow non-admin users to enter horizon dashboard.", function (): void {
    $user = User::factory()
        ->create();

    $this->actingAs($user)
        ->get(route('horizon.index'))
        ->assertUnauthorized();
});

it('opens horizon dashboard to registered admin users.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->withBasicAuth($user->email, config()->string('app.admin_password'))
        ->get(route('horizon.index'))
        ->assertOk();
});
