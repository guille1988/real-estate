<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Faq;
use App\Models\FaqItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends Factory<FaqItem>
 */
final class FaqItemFactory extends Factory
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
            'subtitle' => $this->faker->words(random_int(3, 5), true),
            'paragraphs' => [$this->faker->realTextBetween(), $this->faker->realTextBetween()],
            'faq_id' => Faq::factory(),
        ];
    }
}
