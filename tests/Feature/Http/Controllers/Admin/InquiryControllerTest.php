<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.inquiries.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value);
        });
});
