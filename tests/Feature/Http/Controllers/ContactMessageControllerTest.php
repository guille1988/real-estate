<?php

declare(strict_types=1);

use App\Enums\InquiryTypeEnum;
use App\Enums\SourceEnum;

it('submits contact message form.', function (InquiryTypeEnum $inquiryType, SourceEnum $source): void {
    $data = [
        'first_name' => fake()->firstName(),
        'last_name' => fake()->lastName(),
        'email' => fake()->unique()->safeEmail(),
        'phone' => fake()->phoneNumber(),
        'inquiry_type' => $inquiryType->value,
        'source' => $source->value,
        'message' => fake()->realText(),
        'terms_agreed' => true,
    ];

    $this->post(route('contact.messages'), $data)
        ->assertRedirect();
})->with(InquiryTypeEnum::cases(), SourceEnum::cases());
