<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PropertyTypeEnum;
use App\Models\Image;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

final class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::deleteDirectory(storage_path('app/public/images'));

        File::copyDirectory(
            storage_path('app/private/seeders/images'),
            storage_path('app/public/images'),
        );

        $propertyTypeDirectories = File::directories(storage_path('app/public/images'));

        foreach ($propertyTypeDirectories as $propertyTypeDirectory) {
            $propertyTypeValue = str($propertyTypeDirectory)
                ->afterLast('/')
                ->singular()
                ->toString();

            $propertyType = PropertyTypeEnum::from($propertyTypeValue);
            $imageDirectories = File::directories($propertyTypeDirectory);

            foreach ($imageDirectories as $imageDirectory) {
                $images = File::allFiles($imageDirectory);
                $propertyId = Property::factory()
                    ->create(['type' => $propertyType])->id;

                foreach ($images as $image) {
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
                }
            }
        }
    }
}
