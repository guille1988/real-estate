<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\OfficeLocationTypeEnum;
use App\Models\OfficeLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OfficeLocation>
 */
final class OfficeLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->email(),
            'type' => $this->faker->randomElement(OfficeLocationTypeEnum::cases()),
            'title' => $this->faker->words(2, true),
            'address' => $this->faker->address(),
            'description' => $this->faker->realTextBetween(),
            'phone' => $this->faker->phoneNumber(),
            'location' => $this->faker->city(),
            'url' => $this->faker->url(),
        ];
    }
}
