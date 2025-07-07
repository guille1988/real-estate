<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\FeaturedPropertyResource;
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
            ])->toResourceCollection(FeaturedPropertyResource::class);

        return Inertia::render('Home', [
            'featured_properties' => $featuredProperties,
        ]);
    }
}
