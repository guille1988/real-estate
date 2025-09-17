<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\ImageFormatEnum;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

final class UpdateUserThumbnail
{
    public function execute(User $user, UploadedFile $thumbnail): void
    {
        /**
         * @var string $oldThumbnail
         */
        $oldThumbnail = $user->thumbnail;

        $defaultFormat = ImageFormatEnum::from(
            config()->string('app.default_image_format')
        );

        $path = $user->getThumbnailPath();

        if ($defaultFormat->valueEqualsTo($thumbnail->getExtension())) {
            $thumbnail->storeAs(path: $path, options: ['disk' => 'users']);
        } else {
            $image = $defaultFormat->getEncodeMethod(
                Image::read($thumbnail->getPathname())
            )->toString();

            Storage::disk('users')->putFileAs($path, $image);
        }

        $user->update(['thumbnail' => $path]);

        Storage::disk('users')->delete($oldThumbnail);
    }
}
