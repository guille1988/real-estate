<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\Faq;
use App\Models\FaqItem;
use App\Models\Image;
use App\Models\Property;
use App\Models\Testimonial;
use Inertia\Testing\AssertableInertia as Assert;

it('renders properties on home page.', function (string $key): void {
    $properties = Property::factory(4)
        ->featured()
        ->create()
        ->each(function (Property $property): void {
            Image::factory()
                ->default()
                ->create(['property_id' => $property->id]);
        });

    $this->get(route('home'))
        ->assertInertia(function (Assert $page) use ($properties, $key): void {
            $page->component(PageEnum::HOME->value)
                ->has("$key.data", $properties->count());
        });
})->with(['properties']);

it('works with pagination.', function (): void {
    $perPage = $this->app->make(Property::class)
        ->getPerPage();

    Property::factory($perPage + 10)
        ->featured()
        ->create()
        ->each(function (Property $property): void {
            Image::factory()
                ->default()
                ->create(['property_id' => $property->id]);
        });

    $this->get(route('home', ['page' => 1]))
        ->assertInertia(function (Assert $page) use ($perPage): void {
            $page->component(PageEnum::HOME->value)
                ->has('properties.data', $perPage);
        });
});

it('renders testimonials on home page.', function (string $key): void {
    $testimonials = Testimonial::factory(4)
        ->create();

    $this->get(route('home'))
        ->assertInertia(function (Assert $page) use ($key, $testimonials): void {
            $page->component(PageEnum::HOME->value)
                ->has($key, $testimonials->count());
        });
})->with(['testimonials']);

it('renders frequently asked questions with respective items on home page.', function (string $key, string $field): void {
    Faq::factory($count = 4)
        ->create()
        ->each(function (Faq $faq) use ($count): void {
            FaqItem::factory($count)
                ->create(['faq_id' => $faq->id]);
        });

    $this->get(route('home'))
        ->assertInertia(function (Assert $page) use ($key, $count, $field): void {
            $field = str($field)
                ->camel()
                ->toString();

            foreach (range(0, $count - 1) as $index) {
                $page->component(PageEnum::HOME->value)
                    ->has($key, $count)
                    ->has("$key.$index.$field", $count);
            }
        });
})->with(['faq'], ['faq_items']);
