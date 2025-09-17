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
         * First, we save the old thumbnail and
         * prepare everything to process the new one.
         *
         * @var string $oldThumbnail
         */
        $oldThumbnail = $user->thumbnail;

        $defaultFormat = ImageFormatEnum::from(
            config()->string('app.default_image_format')
        );

        $path = $user->getThumbnailPath();

        /*
         * Second, we check if the thumbnail is already in
         * the desired format. If it is, we just store it.
         * Otherwise, we encode it and store it.
         */
        if ($defaultFormat->valueEqualsTo($thumbnail->getExtension())) {
            $thumbnail->storeAs(path: $path, options: ['disk' => 'users']);
        } else {
            $image = $defaultFormat->getEncodeMethod(
                Image::read($thumbnail->getPathname())
            )->toString();

            Storage::disk('users')->putFileAs($path, $image);
        }

        /*
         * At last, we update the user's thumbnail
         * and gracefully delete the old one, once
         * we know everything went well.
         */
        $user->update(['thumbnail' => $path]);

        Storage::disk('users')->delete($oldThumbnail);
    }
}
