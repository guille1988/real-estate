<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PricingDetailCategoryEnum;
use App\Models\PricingDetail;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends Factory<PricingDetail>
 */
final class PricingDetailFactory extends Factory
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
            'name' => $this->faker->words(random_int(1, 3), true),
            'description' => $this->faker->randomElement([null, $this->faker->sentence()]),
            'category' => $this->faker->randomElement(PricingDetailCategoryEnum::cases()),
            'price' => $this->faker->numberBetween(1000, 100000),
            'property_id' => Property::factory(),
        ];
    }

    public function withoutPrice(): self
    {
        return $this->state(['price' => 0]);
    }
}
