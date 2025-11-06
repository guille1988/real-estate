<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (string $field): void {
    $user = User::factory()
        ->admin()
        ->create();

    $field = str($field)
        ->camel()
        ->toString();

    $this->actingAs($user)
        ->get(route('admin.pricing-details.index'))
        ->assertInertia(function (Assert $page) use ($field): void {
            $page->component(PageEnum::ADMIN_PRICING_DETAILS_INDEX->value)
                ->has($field);
        });
})->with(['pricing_details']);
