<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\AmenityStoreData;
use App\Models\Property;

final readonly class StoreAmenities
{
    public function execute(AmenityStoreData $data): void
    {
        /**
         * @var Property $property
         */
        $property = Property::firstWhere('uuid', $data->property);

        $property->pricingDetails()
            ->createMany($data->amenities);
    }
}
