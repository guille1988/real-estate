<?php

declare(strict_types=1);

use App\Models\Property;
use App\Support\ArrayHelper;

it('works with booleans, integers and strings.', function (bool|int|string $value): void {
    expect(ArrayHelper::transformKeysToCamelCase($value))->toBe($value);
})->with([
    true,
    false,
    88,
    'test',
]);

it('works with empty array.', function (): void {
    $result = ArrayHelper::transformKeysToCamelCase([]);

    expect($result)->toBeEmpty();
});

it('works with empty collection.', function (): void {
    $result = ArrayHelper::transformKeysToCamelCase(collect());

    expect($result)->toBeEmpty();
});

it('works with empty model.', function (): void {
    $result = ArrayHelper::transformKeysToCamelCase(Property::first());

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

    $result = ArrayHelper::transformKeysToCamelCase($array);

    expect(data_get($result, 0))
        ->toBe($data)
        ->and(data_get($result, 'first'))
        ->toBe($data)
        ->and(data_get($result, 'second.nestedKey'))
        ->toBe($data)
        ->and(data_get($result, 'third.nestedKey.nestedNestedKey'))
        ->toBe($data);
})->with([[['one', 'two', 'three']]]);

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

    $result = ArrayHelper::transformKeysToCamelCase($collection);

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

    $result = ArrayHelper::transformKeysToCamelCase($array);

    expect(data_get($result, '0.createdAt'))
        ->toBe($createdAt = $property->created_at->toJSON())
        ->and(data_get($result, 'first.createdAt'))
        ->toBe($createdAt)
        ->and(data_get($result, 'second.nestedKey.createdAt'))
        ->toBe($createdAt)
        ->and(data_get($result, 'third.nestedKey.nestedNestedKey.createdAt'))
        ->toBe($createdAt);
});
