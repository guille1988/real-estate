<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\ImageFormatEnum;
use App\Models\Property;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Image as ImageFacade;
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
        ImageFormatEnum::from(config()->string('images.default_format'))
            ->getEncodeMethod(ImageFacade::fromUpload($image['file']))
            ->storeAs($path = $property->getFilePathForNewImages(), disk: 'images');

        $property->images()
            ->create([
                'path' => $path,
                'is_default' => $image['is_default'],
            ]);
    }
}
