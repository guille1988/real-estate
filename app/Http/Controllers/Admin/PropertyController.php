<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\GetRangeOfMax;
use App\Enums\PageEnum;
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
    public function index(GetRangeOfMax $action): Response
    {
        $properties = Property::query()
            ->forIndexing()
            ->paginate(perPage: 7, page: 1)
            ->through(function (Property $property): JsonResource {
                return IndexPropertyResource::make($property);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_PROPERTIES->value, [
            'properties' => fn (): array => $properties,
            'types' => fn (): Collection => PropertyTypeEnum::toResponse(),
            'bathrooms' => fn (): array => $action->execute('bathrooms'),
            'bedrooms' => fn (): array => $action->execute('bedrooms'),
        ]);
    }
}
