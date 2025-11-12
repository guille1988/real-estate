<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\PricingDetailStoreData;
use App\Models\Property;

final readonly class StorePricingDetails
{
    public function execute(PricingDetailStoreData $data): void
    {
        $pricingDetails = array_map(
            fn (array $pricingDetail): array => $pricingDetail + ['category' => $data->category],
            $data->pricingDetails,
        );

        /**
         * @var Property $property
         */
        $property = Property::firstWhere('uuid', $data->property);

        $property->pricingDetails()
            ->createMany($pricingDetails);
    }
}
