<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\UpdateProfile;
use App\Data\ProfileData;
use App\Enums\PageEnum;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final class ProfileController
{
    public function edit(): Response
    {
        return Inertia::render(PageEnum::ADMIN_PROFILE->value);
    }

    public function update(ProfileData $data, UpdateProfile $action): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        $action->execute($user, $data);

        return back();
    }
}
