<?php

declare(strict_types=1);

use App\Enums\ContactMessageInquiryTypeEnum;
use App\Enums\ContactMessageSourceEnum;
use App\Enums\PageEnum;
use App\Models\ContactMessage;
use App\Models\OfficeLocation;
use Inertia\Testing\AssertableInertia as Assert;

function toCamel(string $key): string
{
    return str($key)
        ->camel()
        ->toString();
}

it('renders contact page.', function (): void {
    OfficeLocation::factory($officeLocationsCount = 4)
        ->create();

    $contactPageResponse = [
        'office_locations' => $officeLocationsCount,
        'inquiry_types' => ContactMessageInquiryTypeEnum::toResponse()->count(),
        'sources' => ContactMessageSourceEnum::toResponse()->count(),
    ];

    $this->get(route('contact.index'))
        ->assertInertia(function (Assert $page) use ($contactPageResponse): void {
            $component = $page->component(PageEnum::CONTACT->value);

            foreach ($contactPageResponse as $key => $count) {
                $component->has(toCamel($key), $count);
            }
        });
});

it('stores a contact message.', function (ContactMessageInquiryTypeEnum $inquiryType, ContactMessageSourceEnum $source): void {
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

    expect(ContactMessage::count())
        ->toBe(1);
})->with(ContactMessageInquiryTypeEnum::cases(), ContactMessageSourceEnum::cases());
