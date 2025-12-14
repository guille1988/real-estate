<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Subscriber;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscriber>
 */
final class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
        ];
    }

    /*
     * Creates the subscriber on a specific date.
     */
    public function createdOn(CarbonImmutable $date): self
    {
        return $this->state([
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
