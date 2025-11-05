<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Property;
use Illuminate\Http\UploadedFile;

final readonly class StoreImagesOnTemporaryDirectory
{
    /**
     * @param  array<int, array{file: UploadedFile, is_default: bool}>  $images
     */
    public function execute(Property $property, array $images): string
    {

        $defaultImage = '';

        foreach ($images as $image) {
            /**
             * @var UploadedFile $file
             */
            $file = $image['file'];

            /**
             * @var string $path
             */
            $path = $file->store($property->uuid, 'tmp');

            if ($image['is_default']) {
                $defaultImage = $path;
            }
        }

        return $defaultImage;
    }
}
