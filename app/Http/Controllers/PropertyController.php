<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GetRangeOfMax;
use App\Data\PropertyData;
use App\Data\PropertyInquireData;
use App\Enums\PageEnum;
use App\Enums\PropertyAreaRangeEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyMessageBudgetEnum;
use App\Enums\PropertyPriceRangeEnum;
use App\Enums\PropertyTypeEnum;
use App\Http\Resources\IndexPropertyResource;
use App\Http\Resources\ShowPropertyResource;
use App\Models\Faq;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class PropertyController
{
    /**
     * @throws Throwable
     */
    public function index(PropertyData $data, GetRangeOfMax $action): Response
    {
        /**
         * @var array<string, mixed> $properties
         */
        $properties = cache()
            ->rememberForever($data->getCacheKey(), function () use ($data) {
                return Property::query()
                    ->search($data)
                    ->paginate(20, page: $data->page)
                    ->through(function (Property $property): JsonResource {
                        return $property->toResource(IndexPropertyResource::class);
                    })->toArray();
            });

        return Inertia::render(PageEnum::PROPERTIES->value, [
            'properties' => fn (): array => $properties,
            'filters' => fn (): array => $data->toArray(),
            'areas' => fn (): Collection => PropertyAreaRangeEnum::toResponse(),
            'locations' => fn (): Collection => PropertyLocationEnum::toResponse(),
            'prices' => fn (): Collection => PropertyPriceRangeEnum::toResponse(),
            'types' => fn (): Collection => PropertyTypeEnum::toResponse(),
            'budgets' => fn (): Collection => PropertyMessageBudgetEnum::toResponse(),
            'bathrooms' => fn (): array => $action->execute('bathrooms'),
            'bedrooms' => fn (): array => $action->execute('bedrooms'),
        ]);
    }

    /**
     * @throws Throwable
     */
    public function show(Property $property): Response
    {
        /**
         * @var bool $canShowProperty
         */
        $canShowProperty = cache()
            ->get(
                $property->getCanShowPropertyCacheKey(),
                $property->canShowProperty(true),
            );

        Gate::allowIf($canShowProperty);

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

    public function inquire(PropertyInquireData $data): RedirectResponse
    {
        /**
         * @var Property $property
         */
        $property = Property::firstWhere('uuid', $data->propertyUuid);
        $property->inquiries()->create($data->toArray());

        return back();
    }
}
