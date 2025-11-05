<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Property;
use Illuminate\Support\Facades\File;
use SplFileInfo;

final readonly class SaveImagesFromPaths
{
    public function execute(
        Property $property,
        string $fullDestinationPath,
        string $destinationPath,
        string $defaultImage,
    ): void {

        $images = collect(File::allFiles($fullDestinationPath))
            ->map(function (SplFileInfo $file) use ($destinationPath, $defaultImage): array {
                $name = $file->getFilename();

                return [
                    'path' => "$destinationPath/$name",
                    'is_default' => str($defaultImage)->contains($name),
                ];
            });

        $property->images()->createMany($images);
    }
}
