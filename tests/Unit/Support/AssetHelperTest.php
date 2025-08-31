<?php

declare(strict_types=1);

use App\Support\AssetHelper;

it('works with arrays.', function (string|array $asset): void {
    $this->app->bind(AssetHelper::class, function (): object {
        return new class
        {
            public function __invoke(string|array $asset): array
            {
                return collect()
                    ->wrap($asset)
                    ->flatMap(fn (string $asset): array => [$asset => 'url'])
                    ->toArray();
            }
        };
    });

    $result = $this->app->call(AssetHelper::class, compact('asset'));

    $keys = is_string($asset)
        ? [$asset]
        : $asset;

    expect($result)
        ->toBeArray()
        ->toHaveKeys($keys);
})->with(['asset', ['asset_one', 'asset_two']]);
