<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\ProfileData;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;

final readonly class UpdateProfile
{
    public function execute(User $user, ProfileData $data): void
    {
        if ($data->hasCurrentPasswordOf($user)) {
            throw ValidationException::withMessages([
                'password' => ['Password cannot be the same as the current password.'],
            ]);

        }

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
