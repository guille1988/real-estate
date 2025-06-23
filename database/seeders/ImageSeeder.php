<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

final class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::factory(100)->create();
    }
}
