<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\PageEnum;
use Inertia\Inertia;
use Inertia\Response;

final class AmenityController
{
    public function index(): Response
    {
        return Inertia::render(PageEnum::ADMIN_AMENITIES_INDEX->value);
    }
}
