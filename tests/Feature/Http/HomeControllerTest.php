<?php

declare(strict_types=1);

use App\Models\Image;
use App\Models\Property;
use Inertia\Testing\AssertableInertia as Assert;

it('works on home page.', function (): void {
    $featuredProperties = Property::factory(4)
        ->featured()
        ->create()
        ->each(function (Property $property): void {
            Image::factory()
                ->default()
                ->create(['property_id' => $property->id]);
        });

    $this->get(route('home'))
        ->assertInertia(function (Assert $page) use ($featuredProperties): void {
            $page->component('Home')
                ->has('featured_properties', $featuredProperties->count());
        });
});
