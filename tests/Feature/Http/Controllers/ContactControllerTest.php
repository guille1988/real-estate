<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\OfficeLocation;
use Inertia\Testing\AssertableInertia as Assert;

it('renders office locations on contact page.', function (string $key): void {
    OfficeLocation::factory($count = 4)
        ->create();

    $this->get(route('contact'))
        ->assertInertia(function (Assert $page) use ($count, $key): void {
            $key = str($key)
                ->camel()
                ->toString();

            $page->component(PageEnum::CONTACT->value)
                ->has($key, $count);
        });
})->with(['office_locations']);
