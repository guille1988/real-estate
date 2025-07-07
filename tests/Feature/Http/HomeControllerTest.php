<?php

declare(strict_types=1);

use App\Models\Image;
use App\Models\Property;

it('works on home page.', function (): void {
    $featuredProperties = Property::factory(4)
        ->featured()
        ->create()
        ->each(function (Property $property): void {
            Image::factory()
                ->default()
                ->create(['property_id' => $property->id]);
        });

    $response = $this->get(route('home'))
        ->inertiaProps('featured_properties');

    collect(data_get($response, 'data'))
        ->each(function (array $property) use ($featuredProperties): void {
            $contains = $featuredProperties->contains('uuid', data_get($property, 'uuid'));
            expect($contains)->toBeTrue();
        });
});
