<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\Property;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($count = 7)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.properties.index'))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_PROPERTIES->value)
                ->has('properties.data', $count);
        });
});
