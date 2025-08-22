<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\PropertyData;
use App\Enums\PageEnum;
use App\Enums\PropertyAreaRangeEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyPriceRangeEnum;
use App\Enums\PropertyTypeEnum;
use App\Http\Resources\IndexPropertyResource;
use App\Http\Resources\ShowPropertyResource;
use App\Models\Faq;
use App\Models\Property;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;
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
            ->paginate(page: $data->page)
            ->through(function (Property $property): JsonResource {
                return IndexPropertyResource::make($property);
            });

        return Inertia::render(PageEnum::PROPERTIES->value, [
            'properties' => fn (): AbstractPaginator => $properties,
            'areas' => fn (): Collection => PropertyAreaRangeEnum::toResponse(),
            'locations' => fn (): Collection => PropertyLocationEnum::toResponse(),
            'prices' => fn (): Collection => PropertyPriceRangeEnum::toResponse(),
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

        $faq = cache()
            ->rememberForever('faq', function (): ResourceCollection {
                return Faq::query()
                    ->with('faqItems:id,uuid,subtitle,paragraphs,faq_id')
                    ->get([
                        'id',
                        'uuid',
                        'title',
                        'description',
                    ])->toResourceCollection();
            });

        return Inertia::render(PageEnum::PROPERTY_DETAILS->value, [
            'property' => fn (): JsonResource => $cachedProperty,
            'faq' => fn (): ResourceCollection => $faq,
        ]);
    }
}
