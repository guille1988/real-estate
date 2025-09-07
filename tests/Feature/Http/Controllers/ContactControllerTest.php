<?php

declare(strict_types=1);

use App\Enums\InquiryTypeEnum;
use App\Enums\PageEnum;
use App\Enums\SourceEnum;
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
        'inquiry_types' => InquiryTypeEnum::toResponse()->count(),
        'sources' => SourceEnum::toResponse()->count(),
    ];

    $this->get(route('contact'))
        ->assertInertia(function (Assert $page) use ($contactPageResponse): void {
            $component = $page->component(PageEnum::CONTACT->value);

            foreach ($contactPageResponse as $key => $count) {
                $component->has(toCamel($key), $count);
            }
        });
});
