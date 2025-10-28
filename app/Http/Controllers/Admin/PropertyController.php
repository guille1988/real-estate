<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\BulkDestroyProperties;
use App\Actions\DestroyProperty;
use App\Actions\GetRangeOfMax;
use App\Data\Admin\PropertyBulkDestroyData;
use App\Data\Admin\PropertyIndexData;
use App\Data\Admin\PropertyStoreData;
use App\Data\Admin\PropertyUpdateData;
use App\Enums\PageEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use App\Http\Resources\Admin\IndexPropertyResource;
use App\Http\Resources\Admin\ShowPropertyResource;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
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
    public function index(PropertyIndexData $data, GetRangeOfMax $action): Response
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
        return Inertia::render(PageEnum::ADMIN_PROPERTIES_CREATE->value, [
            'locations' => fn (): Collection => PropertyLocationEnum::toResponse(),
            'types' => fn (): Collection => PropertyTypeEnum::toResponse(),
        ]);
    }

    public function edit(Property $property): Response
    {
        return Inertia::render(PageEnum::ADMIN_PROPERTIES_EDIT->value, [
            'locations' => fn (): Collection => PropertyLocationEnum::toResponse(),
            'types' => fn (): Collection => PropertyTypeEnum::toResponse(),
            'property' => fn (): array => $property->except(['id', 'created_at', 'updated_at']),
        ]);
    }

    public function show(Property $property): Response
    {
        return Inertia::render(PageEnum::ADMIN_PROPERTIES_SHOW->value, [
            'property' => fn (): JsonResource => $property->toResource(ShowPropertyResource::class),
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(PropertyStoreData $data): RedirectResponse
    {
        Property::create($data->toArray());

        cache()->flush();

        return back();
    }

    /**
     * @throws Throwable
     */
    public function bulkDestroy(PropertyBulkDestroyData $data, BulkDestroyProperties $action): RedirectResponse
    {
        $action->execute($data);

        cache()->flush();

        return back();
    }

    public function update(Property $property, PropertyUpdateData $data): RedirectResponse
    {
        $property->update($data->toArray());

        cache()->flush();

        return back();
    }

    /**
     * @throws Throwable
     */
    public function destroy(Property $property, DestroyProperty $action): RedirectResponse
    {
        $action->execute($property);

        cache()->flush();

        return back();
    }
}
