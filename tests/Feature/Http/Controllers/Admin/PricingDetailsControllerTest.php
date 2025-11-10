<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Enums\PricingDetailCategoryEnum;
use App\Models\PricingDetail;
use App\Models\Property;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    PricingDetail::factory($perPage = 7)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.pricing-details.index'))
        ->assertInertia(function (Assert $page) use ($perPage): void {
            $page->component(PageEnum::ADMIN_PRICING_DETAILS_INDEX->value)
                ->has('pricingDetails')
                ->has('pricingDetails.data', $perPage);
        });
});

it('works with page query string.', function (): void {
    $perPage = 7;

    $user = User::factory()
        ->admin()
        ->create();

    PricingDetail::factory($perPage + 1)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.pricing-details.index', ['page' => 2]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PRICING_DETAILS_INDEX->value)
                ->has('pricingDetails.data', 1);
        });
});

it('works with search by name query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    PricingDetail::factory()
        ->create(['name' => 'AdminTest Alpha']);

    PricingDetail::factory()
        ->create(['name' => 'AdminTest Beta']);

    PricingDetail::factory()
        ->create(['name' => 'Gamma']);

    $this->actingAs($user)
        ->get(route('admin.pricing-details.index', ['search' => 'AdminTest']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PRICING_DETAILS_INDEX->value)
                ->has('pricingDetails.data', 2);
        });
});

it('works searching by property title.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $property = Property::factory()
        ->create(['title' => 'AdminTest Alpha']);

    PricingDetail::factory(2)
        ->for($property)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.pricing-details.index', ['search' => 'Admin']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PRICING_DETAILS_INDEX->value)
                ->has('pricingDetails.data', 2);
        });
});

it('works with category query string.', function (PricingDetailCategoryEnum $category): void {
    $user = User::factory()
        ->admin()
        ->create();

    PricingDetail::factory(2)
        ->create(compact('category'));

    $oppositeCategory = collect(PricingDetailCategoryEnum::cases())->first->isNotEqualTo($category);

    PricingDetail::factory()
        ->create(['category' => $oppositeCategory]);

    $this->actingAs($user)
        ->get(route('admin.pricing-details.index', ['category' => $category->value]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PRICING_DETAILS_INDEX->value)
                ->has('pricingDetails.data', 2);
        });
})->with(function (): array {
    return PricingDetailCategoryEnum::cases();
});

it('works with sort price and direction asc query strings.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    PricingDetail::factory()
        ->create(['price' => 100]);

    PricingDetail::factory()
        ->create(['price' => 300]);

    PricingDetail::factory()
        ->create(['price' => 200]);

    $this->actingAs($user)
        ->get(route('admin.pricing-details.index', ['sort' => 'price', 'direction' => PaginationDirection::ASC->value]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PRICING_DETAILS_INDEX->value)
                ->where('pricingDetails.data.0.price', '$1.00')
                ->where('pricingDetails.data.1.price', '$2.00')
                ->where('pricingDetails.data.2.price', '$3.00');
        });
});

it('works with sort price and direction desc query strings.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    PricingDetail::factory()
        ->create(['price' => 100]);

    PricingDetail::factory()
        ->create(['price' => 300]);

    PricingDetail::factory()
        ->create(['price' => 200]);

    $this->actingAs($user)
        ->get(route('admin.pricing-details.index', ['sort' => 'price', 'direction' => PaginationDirection::DESC->value]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PRICING_DETAILS_INDEX->value)
                ->where('pricingDetails.data.0.price', '$3.00')
                ->where('pricingDetails.data.1.price', '$2.00')
                ->where('pricingDetails.data.2.price', '$1.00');
        });
});

it('works displaying create page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.pricing-details.create'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PRICING_DETAILS_CREATE->value)
                ->has('categories')
                ->has('properties');
        });
});
