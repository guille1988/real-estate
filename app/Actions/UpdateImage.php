<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\ImageUpdateData;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class UpdateImage
{
    /**
     * @throws Throwable
     */
    public function execute(ImageUpdateData $data, Image $image): void
    {
        DB::transaction(function () use ($data, $image): void {
            if ($data->isDefault) {
                Image::query()
                    ->where('property_id', $image->property_id)
                    ->update(['is_default' => false]);
            }

            $image->update(['is_default' => $data->isDefault]);
        });
    }
}
