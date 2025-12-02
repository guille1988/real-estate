<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyMessageBudgetEnum;
use App\Enums\PropertyTypeEnum;
use App\Models\PropertyMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyMessage>
 */
final class PropertyMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'location' => $this->faker->randomElement(PropertyLocationEnum::cases()),
            'property_type' => $this->faker->randomElement(PropertyTypeEnum::cases()),
            'budget' => $this->faker->randomElement(PropertyMessageBudgetEnum::cases()),
            'bedrooms' => $this->faker->numberBetween(1, 4),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'message' => $this->faker->optional()->realTextBetween(),
            'read_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
