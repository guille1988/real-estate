<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Storage;

final class AssetHelper
{
    /**
     * @param  string|array<int, string>  $asset
     * @return array<string, string>
     */
    public function __invoke(string|array $asset): array
    {
        $defaultImageFormat = config()->string('images.default_format');

        /**
         * @var array<string, string> $assets
         */
        $assets = collect()->wrap($asset)
            ->flatMap(function (string $asset) use ($defaultImageFormat): array {
                $path = str($asset)
                    ->append('.', $defaultImageFormat)
                    ->toString();

                $url = Storage::disk('assets')->url($path);

                return [$asset => $url];
            })->toArray();

        return $assets;
    }
}
