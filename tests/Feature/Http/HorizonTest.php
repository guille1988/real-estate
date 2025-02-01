<?php

declare(strict_types=1);

use App\Models\User;

it("doesn't allow unregistered users to enter horizon dashboard.", function (): void {
    $this->get(route('horizon.index'))->assertUnauthorized();
});

it('opens horizon dashboard to registered admin users.', function (): void {
    $this->actingAs(User::first())
        ->withBasicAuth(
            'guill388@hotmail.com',
            'gf33238307'
        )->withHeaders([
            'php_auth_user' => ['guill388@hotmail.com'],
            'php_auth_pw' => ['gf33238307'],
        ])->get(route('horizon.index'))->assertOk();
})->todo();
