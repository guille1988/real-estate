<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\PropertyMessageBulkDestroyData;
use App\Models\PropertyMessage;

final readonly class BulkDestroyPropertyMessages
{
    public function execute(PropertyMessageBulkDestroyData $data): void
    {
        PropertyMessage::query()
            ->whereIn('uuid', $data->uuids)
            ->delete();
    }
}
