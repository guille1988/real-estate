<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\PropertyData;
use App\Enums\PageEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use App\Http\Resources\IndexPropertyResource;
use App\Http\Resources\ShowPropertyResource;
use App\Models\Property;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class PropertyController
{
    /**
     * @throws Throwable
     */
    public function index(PropertyData $data): Response
    {
        $properties = Property::query()
            ->search($data)
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
sleep(5);
        return Inertia::render(PageEnum::PROPERTIES->value, [
            'properties' => fn (): ResourceCollection => $properties,
            'locations' => fn (): Collection => PropertyLocationEnum::toResponse(),
            'types' => fn (): Collection => PropertyTypeEnum::toResponse(),
            'filters' => fn (): array => $data->toArray(),
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
                    'amenities',
                    'images',
                    'pricingDetails',
                ])->toResource(ShowPropertyResource::class);
            }
        );

        return Inertia::render(PageEnum::PROPERTY_DETAILS->value, [
            'property' => fn (): JsonResource => $cachedProperty,
        ]);
    }
}
