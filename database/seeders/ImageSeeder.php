<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Image;
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

        Image::factory(100)->create();
    }
}
