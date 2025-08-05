<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PageEnum;
use App\Http\Resources\IndexPropertyResource;
use App\Http\Resources\ShowPropertyResource;
use App\Models\Property;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class PropertyController
{
    /**
     * @throws Throwable
     */
    public function index(): Response
    {
        $properties = cache()
            ->rememberForever('properties', function (): ResourceCollection {
                return Property::query()
                    ->with('defaultImage:id,path,property_id')
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
                    ])->toResourceCollection(IndexPropertyResource::class);
            });

        return Inertia::render(PageEnum::PROPERTIES->value, [
            'properties' => fn (): ResourceCollection => $properties,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function show(Property $property): Response
    {
        $cachedProperty = cache()->rememberForever(
            "property_$property->uuid",
            function () use ($property): JsonResource {
                return $property->load([
                    'images',
                    'amenities',
                    'pricingDetails',
                ])->toResource(ShowPropertyResource::class);
            }
        );

        return Inertia::render(PageEnum::PROPERTY_DETAILS->value, [
            'property' => fn (): JsonResource => $cachedProperty,
        ]);
    }
}
