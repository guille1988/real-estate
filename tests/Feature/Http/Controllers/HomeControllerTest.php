<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\Image;
use App\Models\Property;
use App\Models\Testimonial;
use Inertia\Testing\AssertableInertia as Assert;

it('renders features properties on home page.', function (string $key): void {
    $featuredProperties = Property::factory(4)
        ->featured()
        ->create()
        ->each(function (Property $property): void {
            Image::factory()
                ->default()
                ->create(['property_id' => $property->id]);
        });

    $this->get(route('home'))
        ->assertInertia(function (Assert $page) use ($key, $featuredProperties): void {
            $page->component(PageEnum::HOME->value)
                ->has(str($key)->camel()->toString(), $featuredProperties->count());
        });
})->with(['featured_properties']);

it('renders testimonials on home page.', function (string $key): void {
    $testimonials = Testimonial::factory(4)
        ->create();

    $this->get(route('home'))
        ->assertInertia(function (Assert $page) use ($key, $testimonials): void {
            $page->component(PageEnum::HOME->value)
                ->has($key, $testimonials->count());
        });
})->with(['testimonials']);
