<?php

declare(strict_types=1);

use App\Support\ArrayHelper;

it('works without any kind of array.', function (): void {
    $data = [
        'first' => 1,
        'second' => [
            'nested_key' => 2,
        ],
    ];

    $result = ArrayHelper::transformKeysToCamelCase($data);

    expect(data_get($result, 'first'))
        ->toBe(1)
        ->and(data_get($result, 'second.nestedKey'))
        ->toBe(2);
});

it('works with empty array.', function (): void {
    $result = ArrayHelper::transformKeysToCamelCase([]);

    expect($result)->toBeEmpty();
});

it('works with arrays.', function (): void {
    $data = [
        [1, 2, 3],
        88 => 88,
        'first' => [1, 2, 3],
        'second' => [
            'nested_key' => [1, 2, 3],
        ],
    ];

    $result = ArrayHelper::transformKeysToCamelCase($data);

    expect(data_get($result, 0))
        ->toBe([1, 2, 3])
        ->and(data_get($result, 88))
        ->toBe(88)
        ->and(data_get($result, 'first'))
        ->toBe([1, 2, 3])
        ->and(data_get($result, 'second.nestedKey'))
        ->toBe([1, 2, 3]);
});

it('works with associative arrays.', function (): void {
    $data = [
        'first' => [
            'compound_key' => 1,
        ],
        'second' => [
            'nested_key' => [
                'nested_compound_key' => 2,
            ],
        ],
    ];

    $result = ArrayHelper::transformKeysToCamelCase($data);

    expect(data_get($result, 'first.compoundKey'))
        ->toBe(1)
        ->and(data_get($result, 'second.nestedKey.nestedCompoundKey'))
        ->toBe(2);
});
