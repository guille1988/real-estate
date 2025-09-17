<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\ProfileData;
use App\Models\User;
use Illuminate\Http\UploadedFile;

final readonly class UpdateProfile
{
    public function __construct(private UpdateUserThumbnail $action) {}

    public function execute(User $user, ProfileData $data): void
    {
        if ($data->hasThumbnail()) {
            /**
             * @var UploadedFile $thumbnail
             */
            $thumbnail = $data->thumbnail;

            $this->action->execute($user, $thumbnail);
        }

        $user->update($data->toArray());
    }
}
