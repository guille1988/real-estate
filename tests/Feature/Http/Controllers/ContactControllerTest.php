<?php

declare(strict_types=1);

use App\Enums\InquiryTypeEnum;
use App\Enums\PageEnum;
use App\Enums\SourceEnum;
use App\Models\OfficeLocation;
use Inertia\Testing\AssertableInertia as Assert;

it('renders office locations on contact page.', function (string $key): void {
    OfficeLocation::factory($count = 4)
        ->create();

    $this->get(route('contact.index'))
        ->assertInertia(function (Assert $page) use ($count, $key): void {
            $key = str($key)
                ->camel()
                ->toString();

            $page->component(PageEnum::CONTACT->value)
                ->has($key, $count);
        });
})->with(['office_locations']);

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

    $this->post(route('contact.store'), $data)
        ->assertRedirect();
})->with(InquiryTypeEnum::cases(), SourceEnum::cases());
