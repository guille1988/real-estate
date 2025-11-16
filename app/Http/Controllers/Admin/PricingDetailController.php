<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\StorePricingDetails;
use App\Actions\UpdatePricingDetail;
use App\Data\Admin\PricingDetailBulkDestroyData;
use App\Data\Admin\PricingDetailIndexData;
use App\Data\Admin\PricingDetailStoreData;
use App\Data\Admin\PricingDetailUpdateData;
use App\Enums\PageEnum;
use App\Enums\PricingDetailCategoryEnum;
use App\Http\Resources\Admin\EditPricingDetailResource;
use App\Http\Resources\Admin\IndexPricingDetailResource;
use App\Http\Resources\Admin\SelectPropertyResource;
use App\Http\Resources\Admin\ShowPricingDetailResource;
use App\Models\PricingDetail;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

final class PricingDetailController
{
    public function index(PricingDetailIndexData $data): Response
    {
        $pricingDetails = PricingDetail::query()
            ->forIndexing($data)
            ->paginate(7, page: $data->page)
            ->withQueryString()
            ->through(function (PricingDetail $pricingDetail): JsonResource {
                return IndexPricingDetailResource::make($pricingDetail);
            })->toArray();

        return Inertia::render(PageEnum::ADMIN_PRICING_DETAILS_INDEX->value, [
            'pricing_details' => fn (): array => $pricingDetails,
            'categories' => fn (): Collection => PricingDetailCategoryEnum::toResponse(),
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

        return Inertia::render(PageEnum::ADMIN_PRICING_DETAILS_CREATE->value, [
            'properties' => fn (): ResourceCollection => $properties,
            'categories' => fn (): Collection => PricingDetailCategoryEnum::toResponse(),
        ]);
    }

    public function show(PricingDetail $pricingDetail): Response
    {
        return Inertia::render(PageEnum::ADMIN_PRICING_DETAILS_SHOW->value, [
            'pricing_detail' => fn (): JsonResource => $pricingDetail->toResource(ShowPricingDetailResource::class),
        ]);
    }

    /**
     * @throws Throwable
     */
    public function edit(PricingDetail $pricingDetail): Response
    {
        $properties = cache()->rememberForever('admin_property_select', function (): ResourceCollection {
            return Property::all(['uuid', 'title'])
                ->toResourceCollection(SelectPropertyResource::class);
        });

        return Inertia::render(PageEnum::ADMIN_PRICING_DETAILS_EDIT->value, [
            'pricing_detail' => fn (): JsonResource => $pricingDetail->toResource(EditPricingDetailResource::class),
            'categories' => fn (): Collection => PricingDetailCategoryEnum::toResponse(),
            'properties' => fn (): ResourceCollection => $properties,
        ]);
    }

    public function store(PricingDetailStoreData $data, StorePricingDetails $action): RedirectResponse
    {
        $action->execute($data);
        cache()->flush();

        return back();
    }

    public function bulkDestroy(PricingDetailBulkDestroyData $data): RedirectResponse
    {
        PricingDetail::query()
            ->whereIn('uuid', $data->uuids)
            ->delete();

        cache()->flush();

        return back();
    }

    public function update(
        PricingDetailUpdateData $data,
        PricingDetail $pricingDetail,
        UpdatePricingDetail $action,
    ): RedirectResponse {
        $action->execute($data, $pricingDetail);
        cache()->flush();

        return back();
    }

    public function destroy(PricingDetail $pricingDetail): RedirectResponse
    {
        $pricingDetail->delete();
        cache()->flush();

        return back();
    }
}
