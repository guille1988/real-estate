<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PricingDetailCategoryEnum;
use App\Enums\PropertyAreaRangeEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyMessageBudgetEnum;
use App\Enums\PropertyPriceRangeEnum;
use App\Enums\PropertyTypeEnum;
use App\Models\Amenity;
use App\Models\Faq;
use App\Models\FaqItem;
use App\Models\Image;
use App\Models\PricingDetail;
use App\Models\Property;
use Inertia\Testing\AssertableInertia as Assert;

it('indexes properties.', function (): void {
    Property::factory($propertyCount = 10)
        ->create()
        ->each(function (Property $property): void {
            Image::factory()
                ->default()
                ->create(['property_id' => $property->id]);
        });

    $propertyPageResponse = [
        'properties.data' => $propertyCount,
        'areas' => PropertyAreaRangeEnum::toResponse()->count(),
        'locations' => PropertyLocationEnum::toResponse()->count(),
        'prices' => PropertyPriceRangeEnum::toResponse()->count(),
        'types' => PropertyTypeEnum::toResponse()->count(),
        'budgets' => PropertyMessageBudgetEnum::toResponse()->count(),
    ];

    $this->get(route('properties.index'))
        ->assertInertia(function (Assert $page) use ($propertyPageResponse): void {
            $component = $page->component(PageEnum::PROPERTIES->value);

            foreach ($propertyPageResponse as $key => $count) {
                $component->has($key, $count);
            }
        });
});

it('works with pagination.', function (): void {
    $perPage = 20;

    Property::factory($perPage + 10)
        ->create()
        ->each(function (Property $property): void {
            Image::factory()
                ->default()
                ->create(['property_id' => $property->id]);
        });

    $this->get(route('properties.index', ['page' => 1]))
        ->assertInertia(function (Assert $page) use ($perPage): void {
            $page->component(PageEnum::PROPERTIES->value)
                ->has('properties.data', $perPage);
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
                ->has('properties.data', 2);
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
                ->has('properties.data', 2);
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
                ->has('properties.data', 2);
        });
})->with(PropertyTypeEnum::cases());

it('works searching for a property by price range.', function (PropertyPriceRangeEnum $range): void {
    $price = fake()->numberBetween(...$range->toArray());

    $property = Property::factory()
        ->create(compact('price'));

    Image::factory()
        ->default()
        ->create(['property_id' => $property->id]);

    $this->get(route('properties.index', ['price' => $range->value]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTIES->value)
                ->has('properties.data', 1);
        });
})->with(PropertyPriceRangeEnum::cases());

it("doesn't work by price range if the query string is invalid.", function (string $price): void {
    $this->get(route('properties.index', compact('price')))
        ->assertSessionHasErrors('price');
})->with([
    '100000/300000',
    '100000-',
    '300000-100000',
    'plus-plus',
]);

it('works searching for a property by area range.', function (PropertyAreaRangeEnum $range): void {
    $area = fake()->numberBetween(...$range->toArray());

    $property = Property::factory()
        ->create(compact('area'));

    Image::factory()
        ->default()
        ->create(['property_id' => $property->id]);

    $this->get(route('properties.index', ['area' => $range->value]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::PROPERTIES->value)
                ->has('properties.data', 1);
        });
})->with(PropertyAreaRangeEnum::cases());

it("doesn't work by area range if the query string is invalid.", function (string $area): void {
    $this->get(route('properties.index', compact('area')))
        ->assertSessionHasErrors('area');
})->with([
    '500/1000',
    '500-',
    '1000-500',
    'plus-plus',
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
                ->has('properties.data', 2);
        });
})->with([true, false]);

it('works showing a specific property.', function (): void {
    $property = Property::factory()
        ->create();

    Image::factory()
        ->default()
        ->create(['property_id' => $property->id]);

    Image::factory(8)
        ->create(['property_id' => $property->id]);

    Amenity::factory(8)
        ->create(['property_id' => $property->id]);

    collect(PricingDetailCategoryEnum::cases())
        ->each(function (PricingDetailCategoryEnum $category) use ($property): void {
            PricingDetail::factory(4)
                ->create([
                    'category' => $category,
                    'property_id' => $property->id,
                ]);
        });

    Faq::factory($count = 4)
        ->create()
        ->each(function (Faq $faq) use ($count): void {
            FaqItem::factory($count)
                ->create(['faq_id' => $faq->id]);
        });

    $this->get(route('properties.show', $property->uuid))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::PROPERTY_DETAILS->value)
                ->has('property');

            foreach (range(0, $count - 1) as $index) {
                $page->component(PageEnum::PROPERTY_DETAILS->value)
                    ->has('faq', $count)
                    ->has("faq.$index.faqItems", $count);
            }
        });
});

it('submits an inquiry.', function (array $data): void {
    $property = Property::factory()
        ->featured()
        ->create();

    $data['property_uuid'] = $property->uuid;

    $this->post(route('properties.inquiries'), $data)
        ->assertRedirect();

    expect($property->fresh()->inquiries->count())
        ->toBe(1);
})->with([
    [
        [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'message' => fake()->realText(),
            'terms_agreed' => true,
        ],
    ],
])->only();
