<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\ImageBulkDestroyData;
use App\Models\Image;

final readonly class BulkDestroyImages
{
    public function execute(ImageBulkDestroyData $data): void
    {
        Image::query()
            ->whereIn('uuid', $data->uuids)
            ->get(['id', 'path'])
            ->each->deleteCompletely();
    }
}
