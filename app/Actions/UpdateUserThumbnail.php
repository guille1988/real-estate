<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\ImageFormatEnum;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class UpdateUserThumbnail
{
    /*
     * Returns the path where the thumbnail will be stored.
     */
    private function getPath(string $format): string
    {
        $parts = [
            '/',
            Str::random(40),
            '.',
            $format,
        ];

        return str('thumbnails')
            ->append(...$parts)
            ->toString();
    }

    public function execute(User $user, UploadedFile $thumbnail): void
    {
        /*
         * First, we save the old thumbnail and
         * prepare everything to process the new one.
         */
        $oldThumbnail = $user->thumbnail;
        $format = config()->string('images.default_format');
        $defaultFormat = ImageFormatEnum::from($format);
        $path = $this->getPath($format);

        /*
         * Second, we check if the thumbnail is already in
         * the desired format. If it is, we just store it.
         * Otherwise, we encode it and store it.
         *
         * The first part of the if statement is covered by the
         * @codeCoverageIgnore tag because it's not possible to
         * test it with Pest.
         */
        if ($defaultFormat->valueEqualsToLowered($thumbnail->getExtension())) {
            $thumbnail->storeAs(path: $path, options: ['disk' => 'users']); // @codeCoverageIgnore
        } else {
            $defaultFormat->getEncodeMethod(Image::fromUpload($thumbnail))
                ->storeAs($path, disk: 'users');
        }

        /*
         * At last, we update the user's thumbnail
         * and gracefully delete the old one if exists,
         * once we know everything went well.
         */
        $user->update(['thumbnail' => $path]);

        if (is_string($oldThumbnail)) {
            Storage::disk('users')->delete($oldThumbnail);
        }
    }
}
