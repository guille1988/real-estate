<?php

declare(strict_types=1);

use App\Enums\PropertyPriceRangeEnum;
use Illuminate\Support\Collection;

it('toArray returns [100000, 300000] for BETWEEN_100_000_AND_300_000.', function (): void {
    expect(PropertyPriceRangeEnum::BETWEEN_100_000_AND_300_000->toArray())
        ->toEqual([100000, 300000]);
});

it('toArray returns [300000, 500000] for BETWEEN_300_000_AND_500_000.', function (): void {
    expect(PropertyPriceRangeEnum::BETWEEN_300_000_AND_500_000->toArray())
        ->toEqual([300000, 500000]);
});

it('toArray returns [500000, 800000] for BETWEEN_500_000_AND_800_000.', function (): void {
    expect(PropertyPriceRangeEnum::BETWEEN_500_000_AND_800_000->toArray())
        ->toEqual([500000, 800000]);
});

it('toArray returns [800000, 1200000] for BETWEEN_800_000_AND_1_200_000.', function (): void {
    expect(PropertyPriceRangeEnum::BETWEEN_800_000_AND_1_200_000->toArray())
        ->toEqual([800000, 1200000]);
});

it('toArray returns [1200000] for MORE_THAN_1_200_000.', function (): void {
    expect(PropertyPriceRangeEnum::MORE_THAN_1_200_000->toArray())
        ->toEqual([1200000]);
});

it('collect returns a collection with [100000, 300000] for BETWEEN_100_000_AND_300_000.', function (): void {
    $range = PropertyPriceRangeEnum::BETWEEN_100_000_AND_300_000->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([100000, 300000]);
});

it('collect returns a collection with [300000, 500000] for BETWEEN_300_000_AND_500_000.', function (): void {
    $range = PropertyPriceRangeEnum::BETWEEN_300_000_AND_500_000->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([300000, 500000]);
});

it('collect returns a collection with [500000, 800000] for BETWEEN_500_000_AND_800_000.', function (): void {
    $range = PropertyPriceRangeEnum::BETWEEN_500_000_AND_800_000->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([500000, 800000]);
});

it('collect returns a collection with [800000, 1200000] for BETWEEN_800_000_AND_1_200_000.', function (): void {
    $range = PropertyPriceRangeEnum::BETWEEN_800_000_AND_1_200_000->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([800000, 1200000]);
});

it('collect returns a collection with [1200000] for MORE_THAN_1_200_000.', function (): void {
    $range = PropertyPriceRangeEnum::MORE_THAN_1_200_000->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([1200000]);
});

it('toResponse contains the correct case for BETWEEN_100_000_AND_300_000.', function (): void {
    $case = PropertyPriceRangeEnum::toResponse()
        ->firstWhere('value', PropertyPriceRangeEnum::BETWEEN_100_000_AND_300_000->value);

    expect($case)
        ->toEqual([
            'label' => '$100,000 - $300,000',
            'value' => PropertyPriceRangeEnum::BETWEEN_100_000_AND_300_000->value,
        ]);
});

it('toResponse contains the correct case for BETWEEN_300_000_AND_500_000.', function (): void {
    $case = PropertyPriceRangeEnum::toResponse()
        ->firstWhere('value', PropertyPriceRangeEnum::BETWEEN_300_000_AND_500_000->value);

    expect($case)
        ->toEqual([
            'label' => '$300,000 - $500,000',
            'value' => PropertyPriceRangeEnum::BETWEEN_300_000_AND_500_000->value,
        ]);
});

it('toResponse contains the correct case for BETWEEN_500_000_AND_800_000.', function (): void {
    $case = PropertyPriceRangeEnum::toResponse()
        ->firstWhere('value', PropertyPriceRangeEnum::BETWEEN_500_000_AND_800_000->value);

    expect($case)
        ->toEqual([
            'label' => '$500,000 - $800,000',
            'value' => PropertyPriceRangeEnum::BETWEEN_500_000_AND_800_000->value,
        ]);
});

it('toResponse contains the correct case for BETWEEN_800_000_AND_1_200_000.', function (): void {
    $case = PropertyPriceRangeEnum::toResponse()
        ->firstWhere('value', PropertyPriceRangeEnum::BETWEEN_800_000_AND_1_200_000->value);

    expect($case)
        ->toEqual([
            'label' => '$800,000 - $1,200,000',
            'value' => PropertyPriceRangeEnum::BETWEEN_800_000_AND_1_200_000->value,
        ]);
});

it('toResponse contains the correct case for MORE_THAN_1_200_000.', function (): void {
    $case = PropertyPriceRangeEnum::toResponse()
        ->firstWhere('value', PropertyPriceRangeEnum::MORE_THAN_1_200_000->value);

    expect($case)
        ->toEqual([
            'label' => '$1,200,000+',
            'value' => PropertyPriceRangeEnum::MORE_THAN_1_200_000->value,
        ]);
});
