<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Property;
use Inertia\Inertia;
use Inertia\Response;

final class HomeController
{
    public function __invoke(): Response
    {
        $featuredProperties = Property::query()
            ->featured()
            ->get([
                'id',
                'uuid',
                'caption',
                'title',
                'description',
                'type',
                'bathrooms',
                'bedrooms',
                'price',
            ])->map(fn (Property $property): array => [
                'uuid' => $property->uuid,
                'caption' => $property->caption,
                'title' => $property->title,
                'description' => $property->description,
                'type' => $property->type,
                'bathrooms' => $property->bathrooms,
                'bedrooms' => $property->bedrooms,
                'price' => $property->price,
                'image' => $property->defaultImage?->path,
            ]);

        return Inertia::render('Home', [
            'featured_properties' => $featuredProperties,
        ]);
    }
}
