<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PageEnum;
use App\Models\Property;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $property = cache()->rememberForever(
            "property_$property->uuid",
            fn (): JsonResource => $property->load(['images', 'amenities'])->toResource()
        );

        return Inertia::render(PageEnum::PROPERTY_DETAILS->value, [
            'property' => fn (): JsonResource => $property,
        ]);
    }
}
