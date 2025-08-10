<?php

declare(strict_types=1);

use App\Support\InertiaRequestHelper;

it('works with associative arrays.', function (array $data): void {
    $result = $this->app->call(InertiaRequestHelper::class, compact('data'));

    expect(data_get($result, 'first_one'))
        ->toBe('first_one')
        ->and(data_get($result, 'second_one.first_nested_one'))
        ->toBe('first_nested_one')
        ->and(data_get($result, 'second_one.second_nested_one.first_nested_nested_one'))
        ->toBe('first_nested_nested_one');
})->with([
    [
        [
            'firstOne' => 'first_one',
            'secondOne' => [
                'firstNestedOne' => 'first_nested_one',
                'secondNestedOne' => [
                    'firstNestedNestedOne' => 'first_nested_nested_one',
                ],
            ],
        ],
    ],
]);

it('works with non associative arrays.', function (array $data): void {
    $result = $this->app->call(InertiaRequestHelper::class, compact('data'));

    expect($result)
        ->toEqualCanonicalizing($data);
})->with([
    [
        [
            'first',
            1,
            true,
        ],
    ],
]);
