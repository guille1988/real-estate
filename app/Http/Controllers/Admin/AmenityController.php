<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\AmenityBulkDestroyData;
use App\Data\Admin\AmenityIndexData;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\AmenityResource;
use App\Models\Amenity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

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
