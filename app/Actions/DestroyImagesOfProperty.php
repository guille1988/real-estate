<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Throwable;

final readonly class DestroyImagesOfProperty
{
    /**
     * @throws Throwable
     */
    public function execute(Property $property): void
    {
        $hasBeenDeleted = Storage::disk('images')
            ->deleteDirectory($property->getFolderPath());

        throw_if(! $hasBeenDeleted, message: 'There was a server error deleting all the images.');

        $property->images()->delete();
    }
}
