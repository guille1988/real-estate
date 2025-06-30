<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PropertyTypeEnum;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
final class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'caption' => $this->faker->sentence(3),
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(),
            'address' => $this->faker->address(),
            'type' => $this->faker->randomElement(PropertyTypeEnum::cases()),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'area' => $this->faker->numberBetween(600, 4_000),
            'price' => $this->faker->numberBetween(600_000, 4_000_000),
            'is_featured' => $this->faker->boolean(),
        ];
    }

    public function featured(): self
    {
        return $this->state(['is_featured' => true]);
    }
}
