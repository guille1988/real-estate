<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Enums\PropertyTypeEnum;
use App\Models\PropertyMessage;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.property-messages.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages')
                ->has('propertyTypes');
        });
});

it('works with page query string.', function (): void {
    $perPage = 9;

    $user = User::factory()
        ->admin()
        ->create();

    PropertyMessage::factory($perPage + 1)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['page' => 2]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages.data', 1);
        });
});

it('validates page query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['page' => 'abc']))
        ->assertSessionHasErrors('page');
});

it('works with search query string for first name, last name and email.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    PropertyMessage::factory()
        ->create(['first_name' => 'AdminTest Alpha']);

    PropertyMessage::factory()
        ->create(['last_name' => 'AdminTest Beta']);

    PropertyMessage::factory()
        ->create(['email' => 'admintest@example.com']);

    PropertyMessage::factory()
        ->create(['first_name' => 'Gamma']);

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['search' => 'AdminTest']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages.data', 3);
        });
});

it('filters by read flag true.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $read = PropertyMessage::factory()
        ->create(['read_at' => now()]);

    PropertyMessage::factory()
        ->create(['read_at' => null]);

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['read' => true]))
        ->assertInertia(function (Assert $page) use ($read): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages.data', 1)
                ->where('propertyMessages.data.0.uuid', $read->uuid)
                ->where('propertyMessages.data.0.readAt', $read->read_at->toDateTimeString());
        });
});

it('filters by read flag false.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    PropertyMessage::factory()
        ->create(['read_at' => now()]);

    $unread = PropertyMessage::factory()
        ->create(['read_at' => null]);

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['read' => false]))
        ->assertInertia(function (Assert $page) use ($unread): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages.data', 1)
                ->where('propertyMessages.data.0.uuid', $unread->uuid)
                ->where('propertyMessages.data.0.readAt', null);
        });
});

it('orders by default id asc when sort is not provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = PropertyMessage::factory()
        ->create(['first_name' => 'Zeta']);

    $second = PropertyMessage::factory()
        ->create(['first_name' => 'Alpha']);

    $this->actingAs($user)
        ->get(route('admin.property-messages.index'))
        ->assertInertia(function (Assert $page) use ($first, $second): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages.data', 2)
                ->where('propertyMessages.data.0.uuid', $first->uuid)
                ->where('propertyMessages.data.1.uuid', $second->uuid);
        });
});

it('orders by id desc when direction is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = PropertyMessage::factory()
        ->create(['first_name' => 'Zeta']);

    $second = PropertyMessage::factory()
        ->create(['first_name' => 'Alpha']);

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['direction' => PaginationDirection::DESC->value]))
        ->assertInertia(function (Assert $page) use ($first, $second): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages.data', 2)
                ->where('propertyMessages.data.0.uuid', $second->uuid)
                ->where('propertyMessages.data.1.uuid', $first->uuid);
        });
});

it('validates direction query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['direction' => 'down']))
        ->assertSessionHasErrors('direction');
});

it('validates sort query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['sort' => 'id']))
        ->assertSessionHasErrors('sort');
});

it('orders by firstName asc when sort is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = PropertyMessage::factory()
        ->create(['first_name' => 'Alpha']);

    $zeta = PropertyMessage::factory()
        ->create(['first_name' => 'Zeta']);

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['sort' => 'firstName']))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages.data', 2)
                ->where('propertyMessages.data.0.uuid', $alpha->uuid)
                ->where('propertyMessages.data.1.uuid', $zeta->uuid);
        });
});

it('orders by lastName desc when sort and direction are provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = PropertyMessage::factory()
        ->create(['last_name' => 'Alpha']);

    $zeta = PropertyMessage::factory()
        ->create(['last_name' => 'Zeta']);

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', [
            'sort' => 'lastName',
            'direction' => PaginationDirection::DESC->value,
        ]))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages.data', 2)
                ->where('propertyMessages.data.0.uuid', $zeta->uuid)
                ->where('propertyMessages.data.1.uuid', $alpha->uuid);
        });
});

it('orders by numeric fields.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $lowBedrooms = PropertyMessage::factory()
        ->create(['bedrooms' => 1]);

    $highBedrooms = PropertyMessage::factory()
        ->create(['bedrooms' => 3]);

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', ['sort' => 'bedrooms']))
        ->assertInertia(function (Assert $page) use ($lowBedrooms, $highBedrooms): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->where('propertyMessages.data.0.uuid', $lowBedrooms->uuid)
                ->where('propertyMessages.data.1.uuid', $highBedrooms->uuid);
        });
});

it('orders by enum fields.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $villa = PropertyMessage::factory()
        ->create(['property_type' => PropertyTypeEnum::VILLA]);

    $apartment = PropertyMessage::factory()
        ->create(['property_type' => PropertyTypeEnum::APARTMENT]);

    $this->actingAs($user)
        ->get(route('admin.property-messages.index', [
            'sort' => 'propertyType',
            'direction' => PaginationDirection::DESC->value,
        ]))->assertInertia(function (Assert $page) use ($villa, $apartment): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->where('propertyMessages.data.0.uuid', $villa->uuid)
                ->where('propertyMessages.data.1.uuid', $apartment->uuid);
        });
});

it('includes property types with all enum values.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.property-messages.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyTypes', count(PropertyTypeEnum::cases()));
        });
});

it('returns empty dataset when no records exist.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.property-messages.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_PROPERTY_MESSAGES_INDEX->value)
                ->has('propertyMessages.data', 0);
        });
});
