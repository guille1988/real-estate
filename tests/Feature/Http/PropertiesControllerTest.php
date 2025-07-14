<?php

declare(strict_types=1);

use App\Enums\PricingDetailCategoryEnum;
use App\Models\Amenity;
use App\Models\Image;
use App\Models\PricingDetail;
use App\Models\Property;

it('works indexing properties.', function (): void {
    $this->get(route('properties.index'))
        ->assertOk();
});

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
        ->assertOk();
});
