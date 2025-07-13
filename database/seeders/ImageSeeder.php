<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PropertyTypeEnum;
use App\Exceptions\NotFoundPropertyTypeException;
use App\Models\Amenity;
use App\Models\Image;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\LazyCollection;
use SplFileInfo;
use Throwable;

final class ImageSeeder extends Seeder
{
    /**
     * Deletes all the current images of the storage.
     */
    private function deleteCurrentImages(): void
    {
        File::deleteDirectory(storage_path('app/public/images'));
    }

    /**
     * Copies seeded images to storage.
     */
    private function copyImagesToSeed(): void
    {
        File::copyDirectory(
            storage_path('app/private/seeders/images'),
            storage_path('app/public/images'),
        );
    }

    /**
     * Seeds all images to the database.
     *
     * @throws Throwable
     */
    private function seedImages(): void
    {
        LazyCollection::make(File::directories(storage_path('app/public/images')))
            ->each(function (mixed $propertyTypeDirectory): void {
                /**
                 * @var string $propertyTypeDirectory
                 */
                LazyCollection::make(File::directories($propertyTypeDirectory))
                    ->each(function (mixed $imageDirectory) use ($propertyTypeDirectory): void {
                        $propertyId = $this->createProperty($propertyTypeDirectory);

                        /**
                         * @var string $imageDirectory
                         */
                        LazyCollection::make(File::allFiles($imageDirectory))
                            ->each(function (SplFileInfo $image) use ($propertyId): void {
                                $this->createImages($image, $propertyId);
                            });
                    });
            });
    }

    /**
     * @throws Throwable
     */
    private function createProperty(string $propertyTypeDirectory): int
    {
        $propertyId = Property::factory()
            ->featured()
            ->create(['type' => $this->getPropertyType($propertyTypeDirectory)])->id;

        Amenity::factory(random_int(4, 8))
            ->create(['property_id' => $propertyId]);

        return $propertyId;
    }

    /**
     * Gets the property type according to the storage directory.
     *
     * @throws Throwable
     */
    private function getPropertyType(string $propertyTypeDirectory): PropertyTypeEnum
    {
        $rawPropertyType = str($propertyTypeDirectory)
            ->afterLast('/')
            ->singular()
            ->toString();

        $propertyType = PropertyTypeEnum::tryFrom($rawPropertyType);
        throw_if(is_null($propertyType), NotFoundPropertyTypeException::class);

        return $propertyType;
    }

    /**
     * Creates images according to the storage path.
     */
    private function createImages(SplFileInfo $image, int $propertyId): void
    {
        $path = str($image->getPathname())
            ->remove(storage_path('app/public/images/'))
            ->toString();

        Image::create([
            'path' => $path,
            'property_id' => $propertyId,
            'is_default' => str($image->getFilename())
                ->contains('default'),
        ]);
    }

    /**
     * Run the database seeds.
     *
     * @throws Throwable
     */
    public function run(): void
    {
        $this->deleteCurrentImages();
        $this->copyImagesToSeed();
        $this->seedImages();
    }
}
