<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
final class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'thumbnail' => $this->faker->imageUrl(),
            'location' => $this->faker->city(),
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->realTextBetween(),
        ];
    }
}
