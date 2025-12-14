<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('redirects to login if there is no session', function (): void {
    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('admin.login.create'));
});

it('works with authenticated user.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_DASHBOARD->value)
                ->has('lastTwelveMonthsMessages')
                ->has('lastSevenDaysMessages')
                ->has('stats');
        });
});
