<?php

declare(strict_types=1);

use App\Models\User;

it('displays profile page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.profile.edit'))
        ->assertOk();
});

it('updates profile page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->patch(route('admin.profile.update'))
        ->assertRedirectBack();
});
