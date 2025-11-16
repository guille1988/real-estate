<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Models\Image;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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

it('works showing create images page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($count = 10)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.images.create'))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_IMAGES_CREATE->value)
                ->has('properties', $count);
        });
});

it('bulk deletes images and clears cache, removing files from storage.', function (): void {
    Storage::fake('images');

    $user = User::factory()
        ->admin()
        ->create();

    $images = Image::factory(3)
        ->create();

    foreach ($images as $image) {
        Storage::disk('images')
            ->put($image->path, 'content');
    }

    cache()->put('to-clear', 'yes');

    $this->from(route('admin.images.index'))
        ->actingAs($user)
        ->post(route('admin.images.bulk-delete'), [
            'uuids' => $images->pluck('uuid')->toArray(),
        ])->assertRedirect(route('admin.images.index'));

    foreach ($images as $image) {
        Storage::disk('images')
            ->assertMissing($image->path);

        expect(Image::query()->whereKey($image->getKey())->exists())
            ->toBeFalse();
    }

    expect(cache()->has('to-clear'))
        ->toBeFalse();
});

it('validates bulk delete request.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->post(route('admin.images.bulk-delete'))
        ->assertSessionHasErrors(['uuids']);

    $valid = Image::factory()
        ->create();

    $this->actingAs($user)
        ->post(route('admin.images.bulk-delete'), [
            'uuids' => ['non-existent', $valid->uuid],
        ])->assertSessionHasErrors(['uuids.0']);

    expect(Image::query()->whereKey($valid->getKey())->exists())
        ->toBeTrue();
});

it('destroys a single image completely and clears cache, keeping folder until last file is removed.', function (): void {
    Storage::fake('images');

    $user = User::factory()->admin()
        ->create();

    $property = Property::factory()
        ->create();

    $folder = "properties/$property->uuid";

    $first = Image::factory()
        ->for($property)
        ->create(['path' => "$folder/a.jpg"]);

    $second = Image::factory()
        ->for($property)
        ->create(['path' => "$folder/b.jpg"]);

    Storage::disk('images')
        ->put($first->path, 'a');

    Storage::disk('images')
        ->put($second->path, 'b');

    cache()->put('bar', 'baz');

    $this->from(route('admin.images.index'))
        ->actingAs($user)
        ->delete(route('admin.images.destroy', $first))
        ->assertRedirect(route('admin.images.index'));

    Storage::disk('images')
        ->assertMissing($first->path);

    Storage::disk('images')
        ->assertExists($second->path);

    expect(Image::query()->whereKey($first->getKey())->exists())
        ->toBeFalse()
        ->and(cache()->has('bar'))
        ->toBeFalse();

    cache()->put('bar', 'baz');

    $this->from(route('admin.images.index'))
        ->actingAs($user)
        ->delete(route('admin.images.destroy', $second))
        ->assertRedirect(route('admin.images.index'));

    Storage::disk('images')
        ->assertMissing($second->path);

    expect(Storage::disk('images')
        ->allFiles($folder))->toBe([]);
});

it('returns 404 when destroying a non-existing image.', function (): void {
    $user = User::factory()->admin()->create();

    $this->actingAs($user)
        ->delete(route('admin.images.destroy', '00000000-0000-0000-0000-000000000000'))
        ->assertNotFound();
});
