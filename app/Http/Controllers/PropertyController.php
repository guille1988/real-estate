<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PageEnum;
use App\Models\Property;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class PropertyController
{
    public function index(): Response
    {
        return Inertia::render(PageEnum::PROPERTIES->value);
    }

    /**
     * @throws Throwable
     */
    public function show(Property $property): Response
    {
        return Inertia::render(PageEnum::PROPERTY_DETAILS->value, [
            'property' => $property->load('images')->toResource(),
        ]);
    }
}
