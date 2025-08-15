<?php

declare(strict_types=1);

use App\Enums\PropertyAreaRangeEnum;
use Illuminate\Support\Collection;

it('toArray returns expected bounds for each case.', function (PropertyAreaRangeEnum $case): void {
    expect($case->toArray())
        ->toEqual($case->collect()->toArray());
})->with(PropertyAreaRangeEnum::cases());

it('collect returns a collection matching toArray for each case.', function (PropertyAreaRangeEnum $case): void {
    $range = $case->collect();

    expect($range)
        ->toBeInstanceOf(Collection::class)
        ->and($range->toArray())
        ->toEqual($case->toArray());
})->with(PropertyAreaRangeEnum::cases());

it('toResponse contains correct label and value for each case.', function (PropertyAreaRangeEnum $case): void {
    $item = PropertyAreaRangeEnum::toResponse()
        ->firstWhere('value', $case->value);

    expect($item)->toEqual([
        'label' => $case->getLabel(),
        'value' => $case->value,
    ]);
})->with(PropertyAreaRangeEnum::cases());
