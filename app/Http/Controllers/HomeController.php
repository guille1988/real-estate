<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PageEnum;
use App\Http\Resources\FeaturedPropertyResource;
use App\Models\Property;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;

final class HomeController
{
    public function __invoke(): Response
    {
        $featuredProperties = cache()
            ->rememberForever('featured_properties', function (): ResourceCollection {
                return Property::query()
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
            });

        return Inertia::render(PageEnum::HOME->value, [
            'featured_properties' => $featuredProperties,
        ]);
    }
}
