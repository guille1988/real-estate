<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

final class PropertySeeder extends Seeder
{
    private array $properties = [
        [
            'caption' => '',
            'title' => '',
            'description' => '',
            'address' => '',
            'type' => '',
            'bathrooms' => '',
            'bedrooms' => '',
            'area' => '',
            'price' => '',
            'is_featured' => '',
            'images' => '',
        ],
        [
            'caption' => '',
            'title' => '',
            'description' => '',
            'address' => '',
            'type' => '',
            'bathrooms' => '',
            'bedrooms' => '',
            'area' => '',
            'price' => '',
            'is_featured' => '',
            'images' => '',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::factory(80)->create();
    }
}
