<?php

declare(strict_types=1);

use App\Enums\PropertyBudgetEnum;
use App\Enums\PropertyLocationEnum;
use App\Enums\PropertyTypeEnum;

it('submits property message form.', function (PropertyLocationEnum $location, PropertyTypeEnum $propertyType, PropertyBudgetEnum $budget): void {
    $data = [
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => fake()->unique()->safeEmail(),
        'phone' => fake()->phoneNumber(),
        'location' => $location->value,
        'property_type' => $propertyType->value,
        'budget' => $budget->value,
        'bedrooms' => fake()->numberBetween(1, 4),
        'bathrooms' => fake()->numberBetween(1, 4),
        'message' => fake()->realText(),
        'terms_agreed' => true,
    ];

    $this->post(route('properties.messages'), $data)
        ->assertRedirect();
})->with(PropertyLocationEnum::cases(), PropertyTypeEnum::cases(), PropertyBudgetEnum::cases())->only();
