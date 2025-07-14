<?php

declare(strict_types=1);

use App\Enums\PricingDetailCategoryEnum;
use App\Models\PricingDetail;

it('contains all proper attributes.', function (): void {
    $amenity = PricingDetail::factory()
        ->create()
        ->fresh();

    expect(array_keys($amenity->toArray()))
        ->toEqual([
            'id',
            'uuid',
            'name',
            'description',
            'category',
            'price',
            'property_id',
            'created_at',
            'updated_at',
        ]);
});

it('has the correct field to implement route model binding.', function (): void {
    expect(PricingDetail::factory()->create()->getRouteKeyName())
        ->toEqual('uuid');
});

it('has the correct fields to implement unique ids.', function (): void {
    expect(PricingDetail::factory()->create()->uniqueIds())
        ->toContain('uuid');
});

it('has a property.', function (): void {
    expect(PricingDetail::factory()->create()->property)
        ->not->toBeNull();
});

it('has the correct dollar price.', function (PricingDetailCategoryEnum $category): void {
    $pricingDetail = PricingDetail::factory()
        ->create(compact('category'));

    $pricingDetailSpecialCase = PricingDetail::factory()
        ->withoutPrice()
        ->create(compact('category'));

    expect($pricingDetail->getDollarPrice())
        ->toBe($pricingDetail->getPrice())
        ->and($pricingDetailSpecialCase->getDollarPrice())
        ->toBe($pricingDetailSpecialCase->getSpecialPrice());
})->with(PricingDetailCategoryEnum::cases());
