<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\PageEnum;
use Inertia\Inertia;
use Inertia\Response;

final class PropertyMessageController
{
    public function index(): Response
    {
        return Inertia::render(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value);
    }
}
