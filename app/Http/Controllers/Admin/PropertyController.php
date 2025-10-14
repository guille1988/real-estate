<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\GetRangeOfMax;
use App\Data\Admin\PropertyData;
use App\Enums\PageEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use App\Http\Resources\Admin\IndexPropertyResource;
use App\Models\Property;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
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
        $properties = Property::query()
            ->forIndexing($data)
            ->paginate(7, page: $data->page)
            ->withQueryString()
            ->through(function (Property $property): JsonResource {
                return IndexPropertyResource::make($property);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_PROPERTIES_INDEX->value, [
            'properties' => fn (): array => $properties,
            'locations' => fn (): Collection => PropertyLocationEnum::toResponse(),
            'types' => fn (): Collection => PropertyTypeEnum::toResponse(),
            'bathrooms' => fn (): array => $action->execute('bathrooms'),
            'bedrooms' => fn (): array => $action->execute('bedrooms'),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render(PageEnum::ADMIN_PROPERTIES_CREATE->value);
    }
}
