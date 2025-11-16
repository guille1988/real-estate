<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\PricingDetailUpdateData;
use App\Models\PricingDetail;
use App\Models\Property;

final readonly class UpdatePricingDetail
{
    public function execute(PricingDetailUpdateData $data, PricingDetail $pricingDetail): void
    {
        /**
         * @var Property $property
         */
        $property = Property::firstWhere('uuid', $data->property);
        $newPricingDetail = $data->toArray() + ['property_id' => $property->id];

        $pricingDetail->update($newPricingDetail);
    }
}
