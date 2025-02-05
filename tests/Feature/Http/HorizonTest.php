<?php

declare(strict_types=1);

use App\Models\User;

it("doesn't allow unregistered users to enter horizon dashboard.", function (): void {
    $this->get(route('horizon.index'))->assertUnauthorized();
});

it("doesn't allow non-admin users to enter horizon dashboard.", function (User $user): void {
    $this->actingAs($user)
        ->get(route('horizon.index'))
        ->assertUnauthorized();
})->with([fn () => User::admin(false)->first()]);

it('opens horizon dashboard to registered admin users.', function (User $admin): void {

    /** @var string $password */
    $password = config('app.admin_password');

    $this->actingAs($admin)
        ->withBasicAuth($admin->email, $password)
        ->get(route('horizon.index'))
        ->assertOk();
})->with([fn () => User::admin()->first()]);
