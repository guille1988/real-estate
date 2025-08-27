<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
final class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'since' => $this->faker->numberBetween(2010, 2024),
            'url' => $this->faker->url(),
            'company' => $this->faker->company(),
            'domain' => $this->faker->domainName(),
            'category' => $this->faker->randomElement(['Real Estate', 'Business', 'Education']),
            'opinion' => $this->faker->realTextBetween(),
        ];
    }
}
