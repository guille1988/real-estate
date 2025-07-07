<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
final class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    private static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => self::$password ??= bcrypt('password'),
            'remember_token' => Str::random(10),
            'is_admin' => false,
        ];
    }

    /**
     * Defines an admin state.
     */
    public function admin(): self
    {
        return $this->state([
            'name' => 'Guillermo Felipetti',
            'email' => 'guill388@hotmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(config()->string('app.admin_password')),
            'is_admin' => true,
        ]);
    }
}
