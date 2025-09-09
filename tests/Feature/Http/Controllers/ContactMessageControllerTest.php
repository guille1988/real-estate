<?php

declare(strict_types=1);

use App\Enums\ContactMessageInquiryTypeEnum;
use App\Enums\ContactMessageSourceEnum;
use App\Models\ContactMessage;

it('submits contact message form.', function (ContactMessageInquiryTypeEnum $inquiryType, ContactMessageSourceEnum $source): void {
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

    expect(ContactMessage::count())
        ->toBe(1);
})->with(ContactMessageInquiryTypeEnum::cases(), ContactMessageSourceEnum::cases());
