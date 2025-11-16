<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\ImageFormatEnum;
use App\Models\Property;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image as ImageFacade;
use Throwable;

final readonly class StoreImageToProperty
{
    /**
     * @param  array{file: UploadedFile, is_default: bool}  $image
     *
     * @throws Throwable
     */
    public function execute(Property $property, array $image): void
    {
        Storage::disk('images')
            ->makeDirectory($property->getFolderPathForNewImages());

        $completePath = Storage::disk('images')
            ->path($path = $property->getFilePathForNewImages());

        ImageFormatEnum::from(config()->string('app.default_image_format'))
            ->getEncodeMethod(ImageFacade::read($image['file']->getPathname()))
            ->save($completePath);

        $property->images()
            ->create([
                'path' => $path,
                'is_default' => $image['is_default'],
            ]);
    }
}
