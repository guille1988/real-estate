<?php

declare(strict_types=1);

use App\Enums\PropertyAreaRangeEnum;
use Illuminate\Support\Collection;

it('toArray returns [500, 1000] for BETWEEN_500_AND_1000.', function (): void {
    expect(PropertyAreaRangeEnum::BETWEEN_500_AND_1000->toArray())
        ->toEqual([500, 1000]);
});

it('toArray returns [1000, 1500] for BETWEEN_1_000_AND_1_500.', function (): void {
    expect(PropertyAreaRangeEnum::BETWEEN_1_000_AND_1_500->toArray())
        ->toEqual([1000, 1500]);
});

it('toArray returns [1500, 2000] for BETWEEN_1_500_AND_2_000.', function (): void {
    expect(PropertyAreaRangeEnum::BETWEEN_1_500_AND_2_000->toArray())
        ->toEqual([1500, 2000]);
});

it('toArray returns [2000, 3000] for BETWEEN_2_000_AND_3_000.', function (): void {
    expect(PropertyAreaRangeEnum::BETWEEN_2_000_AND_3_000->toArray())
        ->toEqual([2000, 3000]);
});

it('toArray returns [3000] for MORE_THAN_3_000.', function (): void {
    expect(PropertyAreaRangeEnum::MORE_THAN_3_000->toArray())
        ->toEqual([3000]);
});

it('collect returns a collection with [500, 1000] for BETWEEN_500_AND_1000.', function (): void {
    $range = PropertyAreaRangeEnum::BETWEEN_500_AND_1000->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([500, 1000]);
});

it('collect returns a collection with [1000, 1500] for BETWEEN_1_000_AND_1_500.', function (): void {
    $range = PropertyAreaRangeEnum::BETWEEN_1_000_AND_1_500->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([1000, 1500]);
});

it('collect returns a collection with [1500, 2000] for BETWEEN_1_500_AND_2_000.', function (): void {
    $range = PropertyAreaRangeEnum::BETWEEN_1_500_AND_2_000->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([1500, 2000]);
});

it('collect returns a collection with [2000, 3000] for BETWEEN_2_000_AND_3_000.', function (): void {
    $range = PropertyAreaRangeEnum::BETWEEN_2_000_AND_3_000->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([2000, 3000]);
});

it('collect returns a collection with [3000] for MORE_THAN_3_000.', function (): void {
    $range = PropertyAreaRangeEnum::MORE_THAN_3_000->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual([3000]);
});

it('toResponse contains the correct case for BETWEEN_500_AND_1000.', function (): void {
    $case = PropertyAreaRangeEnum::toResponse()
        ->firstWhere('value', PropertyAreaRangeEnum::BETWEEN_500_AND_1000->value);

    expect($case)
        ->toEqual([
            'label' => '500 - 1,000 sq ft',
            'value' => PropertyAreaRangeEnum::BETWEEN_500_AND_1000->value,
        ]);
});

it('toResponse contains the correct case for BETWEEN_1_000_AND_1_500.', function (): void {
    $case = PropertyAreaRangeEnum::toResponse()
        ->firstWhere('value', PropertyAreaRangeEnum::BETWEEN_1_000_AND_1_500->value);

    expect($case)
        ->toEqual([
            'label' => '1,000 - 1,500 sq ft',
            'value' => PropertyAreaRangeEnum::BETWEEN_1_000_AND_1_500->value,
        ]);
});

it('toResponse contains the correct case for BETWEEN_1_500_AND_2_000.', function (): void {
    $case = PropertyAreaRangeEnum::toResponse()
        ->firstWhere('value', PropertyAreaRangeEnum::BETWEEN_1_500_AND_2_000->value);

    expect($case)
        ->toEqual([
            'label' => '1,500 - 2,000 sq ft',
            'value' => PropertyAreaRangeEnum::BETWEEN_1_500_AND_2_000->value,
        ]);
});

it('toResponse contains the correct case for BETWEEN_2_000_AND_3_000.', function (): void {
    $case = PropertyAreaRangeEnum::toResponse()
        ->firstWhere('value', PropertyAreaRangeEnum::BETWEEN_2_000_AND_3_000->value);

    expect($case)
        ->toEqual([
            'label' => '2,000 - 3,000 sq ft',
            'value' => PropertyAreaRangeEnum::BETWEEN_2_000_AND_3_000->value,
        ]);
});

it('toResponse contains the correct case for MORE_THAN_3_000.', function (): void {
    $case = PropertyAreaRangeEnum::toResponse()
        ->firstWhere('value', PropertyAreaRangeEnum::MORE_THAN_3_000->value);

    expect($case)
        ->toEqual([
            'label' => '3,000+ sq ft',
            'value' => PropertyAreaRangeEnum::MORE_THAN_3_000->value,
        ]);
});
