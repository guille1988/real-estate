<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ContactMessageInquiryTypeEnum;
use App\Enums\ContactMessageSourceEnum;
use App\Models\ContactMessage;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactMessage>
 */
final class ContactMessageFactory extends Factory
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
            'inquiry_type' => $this->faker->randomElement(ContactMessageInquiryTypeEnum::cases()),
            'source' => $this->faker->randomElement(ContactMessageSourceEnum::cases()),
            'message' => $this->faker->optional()->realText(),
            'read_at' => $this->faker->optional()->dateTime(),
        ];
    }

    /*
     * Creates the contact message on a specific date.
     */
    public function createdOn(CarbonImmutable $date): self
    {
        return $this->state([
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
