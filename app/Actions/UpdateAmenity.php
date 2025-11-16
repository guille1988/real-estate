<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\AmenityUpdateData;
use App\Models\Amenity;
use App\Models\Property;

final readonly class UpdateAmenity
{
    public function execute(AmenityUpdateData $data, Amenity $amenity): void
    {
        /**
         * @var Property $property
         */
        $property = Property::firstWhere('uuid', $data->property);

        $amenity->update([
            'description' => $data->description,
            'property_id' => $property->id,
        ]);
    }
}
