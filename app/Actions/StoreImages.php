<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Admin\ImageStoreData;
use App\Models\Property;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

final readonly class StoreImages
{
    public function __construct(private StoreImageToProperty $action) {}

    /**
     * @throws Throwable
     */
    public function execute(ImageStoreData $data): void
    {
        try {
            DB::beginTransaction();

            /**
             * @var Property $property
             */
            $property = Property::firstWhere('uuid', $data->property);

            // Maintains one default image per property.
            if ($data->containsDefaultImage()) {
                $property->setAllImagesAsNonDefault();
            }

            /**
             * @var array{file: UploadedFile, is_default: bool} $image
             */
            foreach ($data->images as $image) {
                $this->action->execute($property, $image);
            }

            DB::commit();

        } catch (Throwable $exception) {
            DB::rollBack();

            if (isset($property)) {
                Storage::disk('images')
                    ->deleteDirectory($property->getFolderPathForNewImages());
            }

            throw $exception;
        }
    }
}
