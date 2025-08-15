<?php

declare(strict_types=1);

use App\Enums\PropertyPriceRangeEnum;
use Illuminate\Support\Collection;

it('toArray returns expected bounds for each case.', function (PropertyPriceRangeEnum $case): void {
    expect($case->toArray())
        ->toEqual($case->collect()->toArray());
})->with(PropertyPriceRangeEnum::cases());

it('collect returns a collection matching toArray for each case.', function (PropertyPriceRangeEnum $case): void {
    $range = $case->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual($case->toArray());
})->with(PropertyPriceRangeEnum::cases());

it('toResponse contains correct label and value for each case.', function (PropertyPriceRangeEnum $case): void {
    $item = PropertyPriceRangeEnum::toResponse()
        ->firstWhere('value', $case->value);

    expect($item)->toEqual([
        'label' => $case->getLabel(),
        'value' => $case->value,
    ]);
})->with(PropertyPriceRangeEnum::cases());
