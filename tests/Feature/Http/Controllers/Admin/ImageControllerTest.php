<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\Image;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Image::factory($count = 7)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.images.index'))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images')
                ->has('images.data', $count);
        });
});
