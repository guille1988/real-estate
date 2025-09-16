<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('displays profile page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.profile.edit'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROFILE->value)
                ->has('formats')
                ->has('thumbnail');
        });
});

it('updates profile page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->patch(route('admin.profile.update'))
        ->assertRedirectBack();
});
