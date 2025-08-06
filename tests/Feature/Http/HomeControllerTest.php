<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\Image;
use App\Models\Property;
use Inertia\Testing\AssertableInertia as Assert;

it('works on home page.', function (string $properties): void {
    $featuredProperties = Property::factory(4)
        ->featured()
        ->create()
        ->each(function (Property $property): void {
            Image::factory()
                ->default()
                ->create(['property_id' => $property->id]);
        });

    $this->get(route('home'))
        ->assertInertia(function (Assert $page) use ($properties, $featuredProperties): void {
            $page->component(PageEnum::HOME->value)
                ->has(str($properties)->camel()->toString(), $featuredProperties->count());
        });
})->with(['featured_properties']);
