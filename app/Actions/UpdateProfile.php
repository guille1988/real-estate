<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\ProfileData;
use App\Models\User;
use Illuminate\Http\UploadedFile;

final readonly class UpdateProfile
{
    public function execute(User $user, ProfileData $data): void
    {
        if ($data->hasThumbnail()) {
            /**
             * @var UploadedFile $thumbnail
             */
            $thumbnail = $data->thumbnail;

            app(UpdateUserThumbnail::class)->execute($user, $thumbnail);
        }

        $user->update($data->toArray());
    }
}
