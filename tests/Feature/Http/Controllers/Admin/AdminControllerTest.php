<?php

declare(strict_types=1);

use App\Models\User;

it("works redirecting to login when a session isn't active.", function (): void {
    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('admin.login.create'));
});

it('works redirecting to dashboard when a session is active.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin'))
        ->assertRedirect(route('admin.dashboard'));
});
