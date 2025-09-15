<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\ImageFormatEnum;
use App\Enums\PageEnum;
use Inertia\Inertia;
use Inertia\Response;

final class ProfileController
{
    public function edit(): Response
    {
        return Inertia::render(PageEnum::ADMIN_PROFILE->value, [
            'formats' => fn (): string => ImageFormatEnum::toJoin(),
        ]);
    }
}
