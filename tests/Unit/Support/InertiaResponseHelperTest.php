<?php

declare(strict_types=1);

use App\Http\Resources\ShowPropertyResource;
use App\Models\Property;
use App\Support\InertiaResponseHelper;

it('works with booleans, integers and strings.', function (bool|int|string $value): void {
    expect($this->app->call(InertiaResponseHelper::class, ['data' => $value]))
        ->toBe($value);
})->with([
    true,
    false,
    88,
    'test',
]);

it('works with empty array.', function (): void {
    $result = $this->app->call(InertiaResponseHelper::class, ['data' => []]);

    expect($result)->toBeEmpty();
});

it('works with empty collection.', function (): void {
    $result = $this->app->call(InertiaResponseHelper::class, ['data' => collect()]);

    expect($result)->toBeEmpty();
});

it('works with empty model.', function (): void {
    $result = $this->app->call(InertiaResponseHelper::class, ['data' => Property::first()]);

    expect($result)->toBeNull();
});

it('works with arrays.', function (array $data): void {
    $array = [
        $data,
        'first' => $data,
        'second' => [
            'nested_key' => $data,
        ],
        'third' => [
            'nested_key' => [
                'nested_nested_key' => $data,
            ],
        ],
    ];

    $result = $this->app->call(InertiaResponseHelper::class, ['data' => $array]);

    expect(data_get($result, 0))
        ->toBe($data)
        ->and(data_get($result, 'first'))
        ->toBe($data)
        ->and(data_get($result, 'second.nestedKey'))
        ->toBe($data)
        ->and(data_get($result, 'third.nestedKey.nestedNestedKey'))
        ->toBe($data);
})->with([[['one', 'two', 'three']]]);

it('works with closures as value.', function (Closure $closure): void {
    $result = $this->app->call(InertiaResponseHelper::class, ['data' => compact('closure')]);

    expect($result)
        ->toBeArray()
        ->and($result['closure'])
        ->toBeInstanceOf(Closure::class)
        ->and(array_keys($result['closure']()))
        ->toEqualCanonicalizing(['firstKey', 'secondKey']);
})->with([
    fn (): array => ['first_key' => 'firstData', 'second_key' => 'secondData'],
]);

it('works with collections.', function (array $rawData): void {
    $data = collect($rawData);

    $collection = collect([
        $data,
        'first' => $data,
        'second' => [
            'nested_key' => $data,
        ],
        'third' => [
            'nested_key' => [
                'nested_nested_key' => $data,
            ],
        ],
    ]);

    $result = $this->app->call(InertiaResponseHelper::class, ['data' => $collection]);

    expect(data_get($result, 0))
        ->toBe($rawData)
        ->and(data_get($result, 'first'))
        ->toBe($rawData)
        ->and(data_get($result, 'second.nestedKey'))
        ->toBe($rawData)
        ->and(data_get($result, 'third.nestedKey.nestedNestedKey'))
        ->toBe($rawData);
})->with([[['one', 'two', 'three']]]);

it('works with a model.', function (): void {
    $property = Property::factory()
        ->create();

    $array = [
        $property,
        'first' => $property,
        'second' => [
            'nested_key' => $property,
        ],
        'third' => [
            'nested_key' => [
                'nested_nested_key' => $property,
            ],
        ],
    ];

    $result = $this->app->call(InertiaResponseHelper::class, ['data' => $array]);

    expect(data_get($result, '0.createdAt'))
        ->toBe($createdAt = $property->created_at->toJSON())
        ->and(data_get($result, 'first.createdAt'))
        ->toBe($createdAt)
        ->and(data_get($result, 'second.nestedKey.createdAt'))
        ->toBe($createdAt)
        ->and(data_get($result, 'third.nestedKey.nestedNestedKey.createdAt'))
        ->toBe($createdAt);
});

it('works with a model resource.', function (): void {
    $property = Property::factory()
        ->create()
        ->toResource(ShowPropertyResource::class);

    $result = $this->app->call(InertiaResponseHelper::class, ['data' => compact('property')]);

    expect(array_keys(data_get($result, 'property')))
        ->toContain('pricingDetails');
});
