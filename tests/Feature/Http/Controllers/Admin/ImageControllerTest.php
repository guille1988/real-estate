<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Models\Image;
use App\Models\Property;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Image::factory($perPage = 7)->create();

    $this->actingAs($user)
        ->get(route('admin.images.index'))
        ->assertInertia(function (Assert $page) use ($perPage): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images')
                ->has('images.data', $perPage);
        });
});

it('works with page query string.', function (): void {
    $perPage = 7;

    $user = User::factory()
        ->admin()
        ->create();

    Image::factory($perPage + 1)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.images.index', ['page' => 2]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images.data', 1);
        });
});

it('works with search query string (by related property title).', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $matchingOne = Property::factory()
        ->create(['title' => 'AdminTest Alpha']);

    $matchingTwo = Property::factory()
        ->create(['title' => 'AdminTest Beta']);

    $nonMatching = Property::factory()
        ->create(['title' => 'Gamma']);

    Image::factory()->for($matchingOne)->create();
    Image::factory()->for($matchingTwo)->create();
    Image::factory()->for($nonMatching)->create();

    $this->actingAs($user)
        ->get(route('admin.images.index', ['search' => 'AdminTest']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images.data', 2);
        });
});

it('works with is default true query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Image::factory($count = 2)
        ->default()
        ->create();

    Image::factory()
        ->notDefault()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.images.index', ['isDefault' => true]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images.data', $count);
        });
});

it('works with is default false query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Image::factory($count = 2)
        ->notDefault()
        ->create();

    Image::factory()
        ->default()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.images.index', ['is_default' => false]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images.data', $count);
        });
});

it('works with sort created at and direction asc query strings.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $older = Image::factory()
        ->create(['created_at' => now()->subDays(2)]);

    $middle = Image::factory()
        ->create(['created_at' => now()->subDay()]);

    $newer = Image::factory()
        ->create(['created_at' => now()]);

    $this->actingAs($user)
        ->get(route('admin.images.index', ['sort' => 'createdAt', 'direction' => PaginationDirection::ASC->value]))
        ->assertInertia(function (Assert $page) use ($older, $middle, $newer): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->where('images.data.0.uuid', $older->uuid)
                ->where('images.data.1.uuid', $middle->uuid)
                ->where('images.data.2.uuid', $newer->uuid);
        });
});

it('works with sort updated at and direction desc query strings.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = Image::factory()
        ->create(['updated_at' => now()->subDays(2)]);

    $second = Image::factory()
        ->create(['updated_at' => now()->subDay()]);

    $third = Image::factory()
        ->create(['updated_at' => now()]);

    $this->actingAs($user)
        ->get(route('admin.images.index', ['sort' => 'updatedAt', 'direction' => PaginationDirection::DESC->value]))
        ->assertInertia(function (Assert $page) use ($first, $second, $third): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->where('images.data.0.uuid', $third->uuid)
                ->where('images.data.1.uuid', $second->uuid)
                ->where('images.data.2.uuid', $first->uuid);
        });
});
