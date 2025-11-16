<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\AmenityBulkDestroyData;
use App\Data\Admin\AmenityIndexData;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\AmenityResource;
use App\Http\Resources\Admin\SelectPropertyResource;
use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class AmenityController
{
    public function index(AmenityIndexData $data): Response
    {
        $amenities = Amenity::query()
            ->forIndexing($data)
            ->paginate(7, page: $data->page)
            ->withQueryString()
            ->through(function (Amenity $amenity): JsonResource {
                return AmenityResource::make($amenity);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_AMENITIES_INDEX->value, [
            'amenities' => fn (): array => $amenities,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function create(): Response
    {
        $properties = cache()->rememberForever('admin_property_select', function (): ResourceCollection {
            return Property::all(['uuid', 'title'])
                ->toResourceCollection(SelectPropertyResource::class);
        });

        return Inertia::render(PageEnum::ADMIN_AMENITIES_CREATE->value, [
            'properties' => fn (): ResourceCollection => $properties,
        ]);
    }

    public function bulkDestroy(AmenityBulkDestroyData $data): RedirectResponse
    {
        Amenity::query()
            ->whereIn('uuid', $data->uuids)
            ->delete();

        cache()->flush();

        return back();
    }

    public function destroy(Amenity $amenity): RedirectResponse
    {
        $amenity->delete();
        cache()->flush();

        return back();
    }
}
