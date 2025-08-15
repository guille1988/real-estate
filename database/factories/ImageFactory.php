<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Image;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Image>
 */
final class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => 'three_pigs_house.jpeg',
            'is_default' => false,
            'property_id' => Property::factory(),
        ];
    }

    /**
     * Defines the image default state.
     */
    public function default(): self
    {
        return $this->state(['is_default' => true]);
    }

    /**
     * Defines the image not the default state.
     */
    public function notDefault(): self
    {
        return $this->state(['is_default' => false]);
    }
}
