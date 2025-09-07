<?php

declare(strict_types=1);

use App\Actions\GetRangeOfMax;
use App\Models\Property;
use Illuminate\Support\Number;

it("doesn't get range with invalid fields.", function (): void {
    $this->app->make(GetRangeOfMax::class)->execute('invalid');
})->throws(
    InvalidArgumentException::class,
    'The field invalid is not permitted.'
);

it('get ranges with bedrooms and bathrooms.', function (string $field): void {
    Property::factory(3)
        ->create();

    Property::factory()
        ->featured()
        ->create([$field => $max = 8]);

    $result = $this->app->make(GetRangeOfMax::class)->execute($field);

    $lastLabel = data_get($result, array_key_last($result).'.label');
    $spelledCount = ucfirst(Number::spell($max));

    expect($lastLabel)->toBe($spelledCount);

    Cache::forget("max_$field");
})->with(['bathrooms', 'bedrooms']);
