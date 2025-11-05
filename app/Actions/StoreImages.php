<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Property;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

final readonly class StoreImages
{
    public function __construct(
        private StoreImagesOnTemporaryDirectory $storeImagesOnTemporaryDirectory,
        private FormatTemporaryDirectory $formatTemporaryDirectory,
        private BuildFinalDirectory $buildFinalDirectory,
        private SaveImagesFromPaths $saveImagesFromPaths,
    ) {}

    private function handleRollback(string $uuid): void
    {
        collect(['images', 'tmp'])
            ->each(function (string $disk) use ($uuid): void {
                Storage::disk($disk)->deleteDirectory($uuid);
            });
    }

    /**
     * @param  array<int, array{file: UploadedFile, is_default: bool}>  $images
     *
     * @throws Throwable
     */
    public function execute(Property $property, array $images): void
    {
        DB::beginTransaction();

        try {
            $defaultImage = $this->storeImagesOnTemporaryDirectory->execute($property, $images);
            $this->formatTemporaryDirectory->execute($property);

            $fullDestinationPath = Storage::disk('images')
                ->path($destinationPath = $property->getDestinationPath());

            $this->buildFinalDirectory->execute($property, $fullDestinationPath);
            $this->saveImagesFromPaths->execute($property, $fullDestinationPath, $destinationPath, $defaultImage);

            DB::commit();
        } catch (Throwable $exception) {
            $this->handleRollback($property->uuid);
            DB::rollBack();

            throw $exception;
        }
    }
}
