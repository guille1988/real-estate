<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends Factory<Property>
 */
final class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'caption' => $this->faker->words(random_int(3, 4), true),
            'title' => $this->faker->words(random_int(2, 3), true),
            'description' => $this->faker->realTextBetween(300, 500),
            'address' => $this->faker->address(),
            'type' => $this->faker->randomElement(PropertyTypeEnum::cases()),
            'location' => $this->faker->randomElement(PropertyLocationEnum::cases()),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'area' => $this->faker->numberBetween(600, 4_000),
            'price' => $this->faker->numberBetween(100_000, 4_000_000),
            'is_featured' => $this->faker->boolean(),
        ];
    }

    public function featured(): self
    {
        return $this->state(['is_featured' => true]);
    }
}
