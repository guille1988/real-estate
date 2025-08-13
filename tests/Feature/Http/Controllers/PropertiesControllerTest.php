<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PricingDetailCategoryEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use App\Models\Amenity;
use App\Models\Image;
use App\Models\PricingDetail;
use App\Models\Property;
use Inertia\Testing\AssertableInertia as Assert;

it('works indexing properties without any search.', function (): void {
    $this->get(route('properties.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTIES->value);
        });
});

it('works searching for a property.', function (string $title): void {
    $propertyOne = Property::factory()
        ->create([
            'title' => "$title one",
        ]);

    $propertyTwo = Property::factory()
        ->create([
            'title' => "$title two",
        ]);

    Image::factory()
        ->default()
        ->create(['property_id' => $propertyOne->id]);

    Image::factory()
        ->default()
        ->create(['property_id' => $propertyTwo->id]);

    $this->get(route('properties.index', ['search' => $title]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTIES->value)
                ->has('properties', 2);
        });
})->with(['Test']);

it('works searching for a property by location.', function (PropertyLocationEnum $location): void {
    $propertyOne = Property::factory()
        ->create(compact('location'));

    $propertyTwo = Property::factory()
        ->create(compact('location'));

    Image::factory()
        ->default()
        ->create(['property_id' => $propertyOne->id]);

    Image::factory()
        ->default()
        ->create(['property_id' => $propertyTwo->id]);

    $this->get(route('properties.index', ['location' => $location->value]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTIES->value)
                ->has('properties', 2);
        });
})->with(PropertyLocationEnum::cases());

it('works searching for a property by type.', function (PropertyTypeEnum $type): void {
    $propertyOne = Property::factory()
        ->create(compact('type'));

    $propertyTwo = Property::factory()
        ->create(compact('type'));

    Image::factory()
        ->default()
        ->create(['property_id' => $propertyOne->id]);

    Image::factory()
        ->default()
        ->create(['property_id' => $propertyTwo->id]);

    $this->get(route('properties.index', ['type' => $type->value]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTIES->value)
                ->has('properties', 2);
        });
})->with(PropertyTypeEnum::cases());

it('works searching for a property by price range.', function (array $range): void {
    $price = fake()->numberBetween(...$range);

    $property = Property::factory()
        ->create(compact('price'));

    Image::factory()
        ->default()
        ->create(['property_id' => $property->id]);

    $price = collect($range)
        ->implode('-');

    if (! str($price)->contains('-')) {
        $price .= '-plus';
    }

    $this->get(route('properties.index', compact('price')))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTIES->value)
                ->has('properties', 1);
        });
})->with([
    [
        [100000, 300000],
        [300000, 500000],
        [500000, 800000],
        [800000, 1200000],
        [1200000],
    ],
]);

it('works searching for a property by area range.', function (array $range): void {
    $area = fake()->numberBetween(...$range);

    $property = Property::factory()
        ->create(compact('area'));

    Image::factory()
        ->default()
        ->create(['property_id' => $property->id]);

    $area = collect($range)
        ->implode('-');

    if (! str($area)->contains('-')) {
        $area .= '-plus';
    }

    $this->get(route('properties.index', compact('area')))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTIES->value)
                ->has('properties', 1);
        });
})->with([
    [
        [500, 1000],
        [1000, 1500],
        [1500, 2000],
        [2000, 3000],
        [3000],
    ],
]);

it('works searching for a property by featured.', function (bool $isFeatured): void {
    $propertyOne = Property::factory()
        ->create(['is_featured' => $isFeatured]);

    $propertyTwo = Property::factory()
        ->create(['is_featured' => $isFeatured]);

    Image::factory()
        ->default()
        ->create(['property_id' => $propertyOne->id]);

    Image::factory()
        ->default()
        ->create(['property_id' => $propertyTwo->id]);

    $this->get(route('properties.index', ['is_featured' => $isFeatured]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTIES->value)
                ->has('properties', 2);
        });
})->with([true, false]);

it('works showing a specific property.', function (): void {
    $property = Property::factory()
        ->create();

    // Create nine images for the property, one of them is the default one.
    Image::factory()
        ->default()
        ->create(['property_id' => $property->id]);

    Image::factory(8)
        ->create(['property_id' => $property->id]);

    // Create eight amenities for the property.
    Amenity::factory(8)
        ->create(['property_id' => $property->id]);

    // Create four pricing details for each category for the property.
    collect(PricingDetailCategoryEnum::cases())
        ->each(function (PricingDetailCategoryEnum $category) use ($property): void {
            PricingDetail::factory(4)
                ->create([
                    'category' => $category,
                    'property_id' => $property->id,
                ]);
        });

    $this->get(route('properties.show', $property->uuid))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTY_DETAILS->value)
                ->has('property');
        });
});
