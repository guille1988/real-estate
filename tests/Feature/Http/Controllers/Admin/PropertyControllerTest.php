<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use App\Models\Amenity;
use App\Models\Image;
use App\Models\PricingDetail;
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
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->has('properties.data', $count)
                ->has('types')
                ->has('bathrooms')
                ->has('bedrooms');
        });
});

it('works with page query string.', function (): void {
    $perPage = 7;

    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($perPage + 1)->create();

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['page' => 2]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->has('properties.data', 1);
        });
});

it('works with search query string.', function (): void {
    $cases = ['alpha, beta'];

    $user = User::factory()
        ->admin()
        ->create();

    foreach ($cases as $title) {
        Property::factory()
            ->create(['title' => "AdminTest $title"]);
    }

    Property::factory()
        ->create(['title' => 'Gamma']);

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['search' => 'AdminTest']))
        ->assertInertia(function (Assert $page) use ($cases): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->has('properties.data', count($cases));
        });
});

it('works with bathrooms query string.', function (int $bathrooms): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($count = 2)
        ->create(['bathrooms' => $bathrooms]);

    Property::factory()
        ->create(['bathrooms' => $bathrooms + 1]);

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['bathrooms' => $bathrooms]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->has('properties.data', $count);
        });
})->with([1, 2]);

it('works with bedrooms query string.', function (int $bedrooms): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($count = 2)
        ->create(['bedrooms' => $bedrooms]);

    Property::factory()
        ->create(['bedrooms' => $bedrooms + 1]);

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['bedrooms' => $bedrooms]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->has('properties.data', $count);
        });
})->with([1, 3]);

it('works with type query string.', function (PropertyTypeEnum $type): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($count = 2)
        ->create(['type' => $type]);

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['type' => $type->value]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->has('properties.data', $count);
        });
})->with(PropertyTypeEnum::cases());

it('works with location query string.', function (PropertyLocationEnum $location): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($count = 2)
        ->create(['location' => $location]);

    Property::factory()
        ->create(['location' => PropertyLocationEnum::CHARLOTTE]);

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['location' => $location->value]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->has('properties.data', $count);
        });
})->with([PropertyLocationEnum::AUSTIN, PropertyLocationEnum::MIAMI]);

it('works with is featured true query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($count = 2)
        ->create(['is_featured' => true]);

    Property::factory()
        ->create(['is_featured' => false]);

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['is_featured' => true]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->has('properties.data', $count);
        });
});

it('works with is featured false query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($count = 2)
        ->create(['is_featured' => false]);

    Property::factory()
        ->create(['is_featured' => true]);

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['is_featured' => false]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->has('properties.data', $count);
        });
});

it('works with sort title and direction asc query strings.', function (): void {
    $user = User::factory()->admin()->create();

    Property::factory()
        ->create(['title' => 'Zeta']);

    Property::factory()
        ->create(['title' => 'Alpha']);

    Property::factory()
        ->create(['title' => 'Omega']);

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['sort' => 'title', 'direction' => PaginationDirection::ASC->value]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->where('properties.data.0.title', 'Alpha')
                ->where('properties.data.1.title', 'Omega')
                ->where('properties.data.2.title', 'Zeta');
        });
});

it('works with sort price and direction desc query strings.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory()
        ->create(['price' => 100]);

    Property::factory()
        ->create(['price' => 300]);

    Property::factory()
        ->create(['price' => 200]);

    $this->actingAs($user)
        ->get(route('admin.properties.index', ['sort' => 'price', 'direction' => PaginationDirection::DESC->value]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_INDEX->value)
                ->where('properties.data.0.price', '$300')
                ->where('properties.data.1.price', '$200')
                ->where('properties.data.2.price', '$100');
        });
});

it('works on create page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.properties.create'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_CREATE->value)
                ->has('types')
                ->has('locations');
        });
});

it('works on edit page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $property = Property::factory()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.properties.edit', compact('property')))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_EDIT->value)
                ->has('types')
                ->has('locations')
                ->has('property');
        });
});

it('works on show page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $property = Property::factory()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.properties.show', compact('property')))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTIES_SHOW->value)
                ->has('property');
        });
});

it('works on storing property.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $data = Property::factory()
        ->make()
        ->toArray();

    $this->actingAs($user)
        ->post(route('admin.properties.store'), $data)
        ->assertRedirectBack();

    $this->assertDatabaseHas(Property::class, $data);
});

it('works on updating property.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $property = Property::factory()
        ->create();

    $data = Property::factory()
        ->make()
        ->toArray();

    $this->actingAs($user)
        ->patch(route('admin.properties.update', compact('property')), $data)
        ->assertRedirectBack();

    $freshProperty = $property->fresh()
        ->except(['id', 'uuid', 'created_at', 'updated_at']);

    $freshProperty['type'] = $freshProperty['type']->value;
    $freshProperty['location'] = $freshProperty['location']->value;

    expect($freshProperty)->toEqual($data);
});

it('works on destroying property.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $property = Property::factory()
        ->create();

    $folderPath = str($property->type->value)
        ->plural()
        ->append('/', $property->uuid)
        ->toString();

    $createFilePath = fn (string $name): string => str($folderPath)
        ->append('/', $name, '.', config('app.default_image_format'))
        ->toString();

    $hasBeenCreated = Storage::disk('images')
        ->makeDirectory($folderPath);

    expect($hasBeenCreated)
        ->toBeTrue();

    $defaultImage = Image::factory()
        ->default()
        ->for($property)
        ->create(['path' => $createFilePath('default')]);

    $imageOne = Image::factory()
        ->default()
        ->for($property)
        ->create(['path' => $createFilePath('1')]);

    $imageTwo = Image::factory()
        ->default()
        ->for($property)
        ->create(['path' => $createFilePath('2')]);

    $amenityOne = Amenity::factory()
        ->for($property)
        ->create();

    $amenityTwo = Amenity::factory()
        ->for($property)
        ->create();

    $pricingDetailOne = PricingDetail::factory()
        ->for($property)
        ->create();

    $pricingDetailTwo = PricingDetail::factory()
        ->for($property)
        ->create();

    $this->actingAs($user)
        ->delete(route('admin.properties.destroy', ['property' => $property->uuid]))
        ->assertRedirectBack();

    $missingModels = [
        $property,
        $defaultImage,
        $imageOne,
        $imageTwo,
        $amenityOne,
        $amenityTwo,
        $pricingDetailOne,
        $pricingDetailTwo,
    ];

    foreach ($missingModels as $model) {
        $this->assertModelMissing($model);
    }

    $paths = [
        $folderPath,
        $defaultImage->path,
        $imageOne->path,
        $imageTwo->path,
    ];

    foreach ($paths as $path) {
        expect(File::exists($path))
            ->toBeFalse();
    }
});

it('works on bulk destroying properties.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $property = Property::factory()
        ->create();

    $folderPath = str($property->type->value)
        ->plural()
        ->append('/', $property->uuid)
        ->toString();

    $createFilePath = fn (string $name): string => str($folderPath)
        ->append('/', $name, '.', config('app.default_image_format'))
        ->toString();

    $hasBeenCreated = Storage::disk('images')
        ->makeDirectory($folderPath);

    expect($hasBeenCreated)
        ->toBeTrue();

    $defaultImage = Image::factory()
        ->default()
        ->for($property)
        ->create(['path' => $createFilePath('default')]);

    $imageOne = Image::factory()
        ->default()
        ->for($property)
        ->create(['path' => $createFilePath('1')]);

    $imageTwo = Image::factory()
        ->default()
        ->for($property)
        ->create(['path' => $createFilePath('2')]);

    $amenityOne = Amenity::factory()
        ->for($property)
        ->create();

    $amenityTwo = Amenity::factory()
        ->for($property)
        ->create();

    $pricingDetailOne = PricingDetail::factory()
        ->for($property)
        ->create();

    $pricingDetailTwo = PricingDetail::factory()
        ->for($property)
        ->create();

    $this->actingAs($user)
        ->post(route('admin.properties.bulk-delete'), ['uuids' => [$property->uuid]])
        ->assertRedirectBack();

    $missingModels = [
        $property,
        $defaultImage,
        $imageOne,
        $imageTwo,
        $amenityOne,
        $amenityTwo,
        $pricingDetailOne,
        $pricingDetailTwo,
    ];

    foreach ($missingModels as $model) {
        $this->assertModelMissing($model);
    }

    $paths = [
        $folderPath,
        $defaultImage->path,
        $imageOne->path,
        $imageTwo->path,
    ];

    foreach ($paths as $path) {
        expect(File::exists($path))
            ->toBeFalse();
    }
});
