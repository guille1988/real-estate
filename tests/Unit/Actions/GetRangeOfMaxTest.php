<?php

declare(strict_types=1);

use App\Actions\GetRangeOfMax;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Number;

it("doesn't get range with invalid fields.", function (): void {
    $this->app->make(GetRangeOfMax::class)->execute('invalid');
})->throws(
    InvalidArgumentException::class,
    'The field invalid is not permitted.'
);

it('get ranges with bedrooms and bathrooms.', function (string $field): void {
    Cache::forget('max_bedrooms');

    Cache::shouldReceive('rememberForever')
        ->once()
        ->with("max_$field", Closure::class)
        ->andReturn($count = 4);

    $result = $this->app->make(GetRangeOfMax::class)->execute($field);

    $lastLabel = data_get($result, array_key_last($result).'.label');
    $spelledCount = ucfirst(Number::spell($count));

    expect($lastLabel)->toBe($spelledCount);
})->with(['bathrooms', 'bedrooms']);
