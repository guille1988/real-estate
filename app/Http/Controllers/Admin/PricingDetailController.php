<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\Admin\PricingDetailIndexData;
use App\Enums\PageEnum;
use App\Http\Resources\Admin\IndexPricingDetailResource;
use App\Models\PricingDetail;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

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
        ]);
    }
}
