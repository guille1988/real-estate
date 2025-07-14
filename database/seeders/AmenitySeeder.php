<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Database\Seeder;

final class AmenitySeeder extends Seeder
{
    /**
     * @var array<string>
     */
    private array $amenities = [
        'Expansive oceanfront terrace for outdoor entertaining',
        'Gourmet kitchen with top-of-the-line appliances',
        'Private beach access for morning strolls and sunset views',
        'Master suite with a spa-inspired bathroom and ocean-facing balcony',
        'Private garage and ample storage space',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * @var array<int, array<string, mixed>> $amenities
         */
        $amenities = Property::query()
            ->get('id')
            ->flatMap(function (Property $property): array {
                return array_map(fn (string $description): array => [
                    'description' => $description,
                    'property_id' => $property->id,
                ], $this->amenities);
            })->toArray();

        Amenity::fillAndInsert($amenities);
    }
}
