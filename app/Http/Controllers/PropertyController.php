<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PageEnum;
use Inertia\Inertia;
use Inertia\Response;

final class PropertyController
{
    public function index(): Response
    {
        return Inertia::render(PageEnum::PROPERTIES->value);
    }

    public function show(int $id): Response
    {
        return Inertia::render(PageEnum::PROPERTY_DETAILS->value, compact('id'));
    }
}
