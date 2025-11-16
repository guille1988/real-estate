<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Models\Amenity;
use App\Models\Property;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.amenities.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value);
        });
});

it('works with page query string.', function (): void {
    $perPage = 7;

    $user = User::factory()
        ->admin()
        ->create();

    Amenity::factory($perPage + 1)->create();

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['page' => 2]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 1);
        });
});

it('validates page query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['page' => 'abc']))
        ->assertSessionHasErrors('page');
});

it('works with search query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Amenity::factory()
        ->create(['description' => 'AdminTest Alpha']);

    Amenity::factory()
        ->create(['description' => 'AdminTest Beta']);

    Amenity::factory()
        ->create(['description' => 'Gamma']);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['search' => 'AdminTest']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2);
        });
});

it('orders by default id asc when sort is not provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = Amenity::factory()
        ->create(['description' => 'Zeta']);

    $second = Amenity::factory()
        ->create(['description' => 'Alpha']);

    $this->actingAs($user)
        ->get(route('admin.amenities.index'))
        ->assertInertia(function (Assert $page) use ($first, $second): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2)
                ->where('amenities.data.0.uuid', $first->uuid)
                ->where('amenities.data.1.uuid', $second->uuid);
        });
});

it('orders by id desc when direction is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = Amenity::factory()
        ->create(['description' => 'Zeta']);

    $second = Amenity::factory()
        ->create(['description' => 'Alpha']);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['direction' => PaginationDirection::DESC->value]))
        ->assertInertia(function (Assert $page) use ($first, $second): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2)
                ->where('amenities.data.0.uuid', $second->uuid)
                ->where('amenities.data.1.uuid', $first->uuid);
        });
});

it('validates direction query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['direction' => 'down']))
        ->assertSessionHasErrors('direction');
});

it('validates sort query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['sort' => 'id']))
        ->assertSessionHasErrors('sort');
});

it('orders by description asc when sort is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = Amenity::factory()
        ->create(['description' => 'Alpha']);

    $zeta = Amenity::factory()
        ->create(['description' => 'Zeta']);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['sort' => 'description']))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2)
                ->where('amenities.data.0.uuid', $alpha->uuid)
                ->where('amenities.data.1.uuid', $zeta->uuid);
        });
});

it('orders by description desc when sort and direction are provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = Amenity::factory()
        ->create(['description' => 'Alpha']);

    $zeta = Amenity::factory()
        ->create(['description' => 'Zeta']);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', [
            'sort' => 'description',
            'direction' => PaginationDirection::DESC->value,
        ]))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2)
                ->where('amenities.data.0.uuid', $zeta->uuid)
                ->where('amenities.data.1.uuid', $alpha->uuid);
        });
});

it('works combining search, direction and page.', function (): void {
    $perPage = 7;

    $user = User::factory()
        ->admin()
        ->create();

    Amenity::factory()
        ->create(['description' => 'AdminTest 1']);

    Amenity::factory()
        ->create(['description' => 'AdminTest 2']);

    Amenity::factory($perPage)
        ->create(['description' => 'Other']);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', [
            'search' => 'AdminTest',
            'direction' => PaginationDirection::DESC->value,
            'page' => 1,
        ]))->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2);
        });
});

it('orders by createdAt asc when sort is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $older = Amenity::factory()
        ->create([
            'description' => 'Older',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(2),
        ]);

    $newer = Amenity::factory()
        ->create([
            'description' => 'Newer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['sort' => 'createdAt']))
        ->assertInertia(function (Assert $page) use ($older, $newer): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2)
                ->where('amenities.data.0.uuid', $older->uuid)
                ->where('amenities.data.1.uuid', $newer->uuid);
        });
});

it('orders by createdAt desc when sort and direction are provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $older = Amenity::factory()
        ->create([
            'description' => 'Older',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(2),
        ]);

    $newer = Amenity::factory()
        ->create([
            'description' => 'Newer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', [
            'sort' => 'createdAt',
            'direction' => PaginationDirection::DESC->value,
        ]))
        ->assertInertia(function (Assert $page) use ($older, $newer): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2)
                ->where('amenities.data.0.uuid', $newer->uuid)
                ->where('amenities.data.1.uuid', $older->uuid);
        });
});

it('orders by updatedAt asc when sort is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $lessRecentUpdate = Amenity::factory()
        ->create([
            'description' => 'Less Recent',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(2),
        ]);

    $moreRecentUpdate = Amenity::factory()
        ->create([
            'description' => 'More Recent',
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDay(),
        ]);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['sort' => 'updatedAt']))
        ->assertInertia(function (Assert $page) use ($lessRecentUpdate, $moreRecentUpdate): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2)
                ->where('amenities.data.0.uuid', $lessRecentUpdate->uuid)
                ->where('amenities.data.1.uuid', $moreRecentUpdate->uuid);
        });
});

it('orders by updatedAt desc when sort and direction are provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $lessRecentUpdate = Amenity::factory()
        ->create([
            'description' => 'Less Recent',
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDays(3),
        ]);

    $moreRecentUpdate = Amenity::factory()
        ->create([
            'description' => 'More Recent',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDay(),
        ]);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', [
            'sort' => 'updatedAt',
            'direction' => PaginationDirection::DESC->value,
        ]))
        ->assertInertia(function (Assert $page) use ($lessRecentUpdate, $moreRecentUpdate): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 2)
                ->where('amenities.data.0.uuid', $moreRecentUpdate->uuid)
                ->where('amenities.data.1.uuid', $lessRecentUpdate->uuid);
        });
});

it('searches by property title when search matches related property.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $matchingProperty = Property::factory()
        ->create([
            'title' => 'AdminTest Sunny House',
        ]);

    Amenity::factory()
        ->create([
            'description' => 'Does not contain term',
            'property_id' => $matchingProperty->id,
        ]);

    $otherProperty = Property::factory()
        ->create([
            'title' => 'Cozy Cabin',
        ]);

    Amenity::factory()
        ->create([
            'description' => 'Also without keyword',
            'property_id' => $otherProperty->id,
        ]);

    $this->actingAs($user)
        ->get(route('admin.amenities.index', ['search' => 'AdminTest']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_AMENITIES_INDEX->value)
                ->has('amenities.data', 1);
        });
});

it('deletes an amenity.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $amenity = Amenity::factory()
        ->create();

    $this->actingAs($user)
        ->delete(route('admin.amenities.destroy', $amenity->uuid))
        ->assertRedirectBack();

    $this->assertModelMissing($amenity);
});

it('bulks delete amenities.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $amenities = Amenity::factory(2)
        ->create();

    $this->actingAs($user)
        ->post(
            route('admin.amenities.bulk-delete'),
            ['uuids' => $amenities->pluck('uuid')->toArray()],
        )->assertRedirectBack();

    $amenities->each(function (Amenity $amenity): void {
        $this->assertModelMissing($amenity);
    });
});
