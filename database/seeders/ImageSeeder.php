<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PropertyTypeEnum;
use App\Models\Image;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use SplFileInfo;

final class ImageSeeder extends Seeder
{
    private function deleteCurrentImages(): void
    {
        File::deleteDirectory(storage_path('app/public/images'));
    }

    private function copyImagesToSeed(): void
    {
        File::copyDirectory(
            storage_path('app/private/seeders/images'),
            storage_path('app/public/images'),
        );
    }

    private function seedImages(): void
    {
        collect(File::directories(storage_path('app/public/images')))
            ->each(function (mixed $propertyTypeDirectory): void {

                /**
                 * @var string $propertyTypeDirectory
                 */
                $propertyType = str($propertyTypeDirectory)
                    ->afterLast('/')
                    ->singular()
                    ->toString();

                collect(File::directories($propertyTypeDirectory))
                    ->each(function (mixed $imageDirectory) use ($propertyType): void {
                        $propertyId = Property::factory()
                            ->create([
                                'type' => PropertyTypeEnum::from($propertyType),
                            ])->id;

                        /**
                         * @var string $imageDirectory
                         */
                        collect(File::allFiles($imageDirectory))
                            ->each(function (SplFileInfo $image) use ($propertyId): void {
                                $path = str($image->getPathname())
                                    ->remove(storage_path('app/public/images/'))
                                    ->toString();

                                Image::factory()
                                    ->create([
                                        'path' => $path,
                                        'property_id' => $propertyId,
                                        'is_default' => str($image->getFilename())
                                            ->contains('default'),
                                    ]);
                            });
                    });
            });
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->deleteCurrentImages();
        $this->copyImagesToSeed();
        $this->seedImages();
    }
}
