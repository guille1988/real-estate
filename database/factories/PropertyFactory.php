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
            'caption' => $this->faker->word(),
            'title' => $this->faker->title(),
            'description' => $this->faker->sentence(),
            'address' => $this->faker->address(),
            'type' => $this->faker->randomElement(PropertyTypeEnum::cases()),
            'bathrooms' => random_int(1, 5),
            'bedrooms' => random_int(1, 5),
            'area' => random_int(600, 4_000),
            'price' => random_int(600_000, 4_000_000),
            'is_featured' => $this->faker->boolean(),
        ];
    }
}
