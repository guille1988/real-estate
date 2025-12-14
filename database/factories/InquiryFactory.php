<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Inquiry;
use App\Models\Property;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inquiry>
 */
final class InquiryFactory extends Factory
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
            'message' => $this->faker->optional()->realText(),
            'read_at' => $this->faker->optional()->dateTime(),
            'property_id' => Property::factory(),
        ];
    }

    /*
     * Mark the inquiry as unread.
     */
    public function unread(): self
    {
        return $this->state(['read_at' => null]);
    }

    /*
     * Create the inquiry on a specific date.
     */
    public function createdOn(CarbonImmutable $date): self
    {
        return $this->state([
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
