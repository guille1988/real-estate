<?php

declare(strict_types=1);

use App\Enums\PageEnum;
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

it('submits contact message form.', function (array $data): void {
    $this->post(route('contact.store'), $data)
        ->assertRedirect();
})->with([
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john@example.com',
    'phone' => '1234567890',
    'inquiry_type' => 'other',
    'source' => 'other',
    'message' => 'Hello',
    'terms_agreed' => true,
])
    ->skip('Pending back-end implementation.')
    ->todo('Test also error handling logic.');
