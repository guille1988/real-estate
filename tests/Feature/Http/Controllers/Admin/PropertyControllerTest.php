<?php

declare(strict_types=1);

use App\Models\User;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.properties.index'))
        ->assertOk();
});
