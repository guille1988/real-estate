<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\PropertyBulkDestroyData;
use App\Models\Property;
use Throwable;

final readonly class BulkDestroyProperties
{
    public function __construct(private DestroyProperty $action) {}

    /**
     * @throws Throwable
     */
    public function execute(PropertyBulkDestroyData $data): void
    {
        Property::query()
            ->whereIn('uuid', $data->uuids)
            ->get(['id'])
            ->each(function (Property $property): void {
                $this->action->execute($property);
            });
    }
}
