<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Property;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

final readonly class BuildFinalDirectory
{
    public function execute(Property $property, string $fullDestinationPath): void
    {

        File::copyDirectory(
            Storage::disk('tmp')->path($property->uuid),
            $fullDestinationPath,
        );

        Storage::disk('tmp')
            ->deleteDirectory($property->uuid);

        if (File::isEmptyDirectory(Storage::disk('tmp')->path(''))) {
            Storage::disk('tmp')->deleteDirectory('');
        }
    }
}
