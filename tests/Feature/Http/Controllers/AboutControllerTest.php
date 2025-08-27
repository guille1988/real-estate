<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Models\Client;
use App\Models\Team;
use Inertia\Testing\AssertableInertia as Assert;

it('renders team on about page.', function (): void {
    Team::factory($count = 4)
        ->create();

    Client::factory($count)
        ->create();

    $this->get(route('about'))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ABOUT->value)
                ->has('team', $count)
                ->has('clients', $count);
        });
});
