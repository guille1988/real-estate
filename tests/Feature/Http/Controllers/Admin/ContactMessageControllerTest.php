<?php

declare(strict_types=1);

use App\Enums\ContactMessageInquiryTypeEnum;
use App\Enums\ContactMessageSourceEnum;
use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Models\ContactMessage;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages')
                ->has('inquiryTypes')
                ->has('sources');
        });
});

it('works with page query string.', function (): void {
    $perPage = 9;

    $user = User::factory()
        ->admin()
        ->create();

    ContactMessage::factory($perPage + 1)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['page' => 2]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 1);
        });
});

it('validates page query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['page' => 'abc']))
        ->assertSessionHasErrors('page');
});

it('works with search query string for first name, last name, email and phone.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    ContactMessage::factory()
        ->create(['first_name' => 'AdminTest Alpha']);

    ContactMessage::factory()
        ->create(['last_name' => 'AdminTest Beta']);

    ContactMessage::factory()
        ->create(['email' => 'admintest@example.com']);

    ContactMessage::factory()
        ->create(['phone' => '1234567890-test']);

    ContactMessage::factory()
        ->create(['first_name' => 'Gamma']);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['search' => 'test']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 4);
        });
});

it('filters by read flag true.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $read = ContactMessage::factory()
        ->create(['read_at' => now()]);

    ContactMessage::factory()
        ->create(['read_at' => null]);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['read' => true]))
        ->assertInertia(function (Assert $page) use ($read): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 1)
                ->where('contactMessages.data.0.uuid', $read->uuid)
                ->where('contactMessages.data.0.readAt', $read->read_at->toDateTimeString());
        });
});

it('filters by read flag false.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    ContactMessage::factory()
        ->create(['read_at' => now()]);

    $unread = ContactMessage::factory()
        ->create(['read_at' => null]);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['read' => false]))
        ->assertInertia(function (Assert $page) use ($unread): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 1)
                ->where('contactMessages.data.0.uuid', $unread->uuid)
                ->where('contactMessages.data.0.readAt', null);
        });
});

it('filters by inquiry type.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $buy = ContactMessage::factory()
        ->create(['inquiry_type' => ContactMessageInquiryTypeEnum::BUY]);

    ContactMessage::factory()
        ->create(['inquiry_type' => ContactMessageInquiryTypeEnum::RENT]);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['inquiryType' => ContactMessageInquiryTypeEnum::BUY->value]))
        ->assertInertia(function (Assert $page) use ($buy): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 1)
                ->where('contactMessages.data.0.uuid', $buy->uuid);
        });
});

it('filters by source.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $search = ContactMessage::factory()
        ->create(['source' => ContactMessageSourceEnum::SEARCH]);

    ContactMessage::factory()
        ->create(['source' => ContactMessageSourceEnum::SOCIAL]);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['source' => ContactMessageSourceEnum::SEARCH->value]))
        ->assertInertia(function (Assert $page) use ($search): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 1)
                ->where('contactMessages.data.0.uuid', $search->uuid);
        });
});

it('orders by default id asc when sort is not provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = ContactMessage::factory()
        ->create(['first_name' => 'Zeta']);

    $second = ContactMessage::factory()
        ->create(['first_name' => 'Alpha']);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index'))
        ->assertInertia(function (Assert $page) use ($first, $second): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 2)
                ->where('contactMessages.data.0.uuid', $first->uuid)
                ->where('contactMessages.data.1.uuid', $second->uuid);
        });
});

it('orders by firstName asc when sort is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = ContactMessage::factory()
        ->create(['first_name' => 'Alpha']);

    $zeta = ContactMessage::factory()
        ->create(['first_name' => 'Zeta']);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['sort' => 'firstName']))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 2)
                ->where('contactMessages.data.0.uuid', $alpha->uuid)
                ->where('contactMessages.data.1.uuid', $zeta->uuid);
        });
});

it('orders by lastName desc when sort and direction are provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = ContactMessage::factory()
        ->create(['last_name' => 'Alpha']);

    $zeta = ContactMessage::factory()
        ->create(['last_name' => 'Zeta']);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', [
            'sort' => 'lastName',
            'direction' => PaginationDirection::DESC->value,
        ]))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 2)
                ->where('contactMessages.data.0.uuid', $zeta->uuid)
                ->where('contactMessages.data.1.uuid', $alpha->uuid);
        });
});

it('orders by enum fields inquiry type.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $buy = ContactMessage::factory()
        ->create(['inquiry_type' => ContactMessageInquiryTypeEnum::BUY]);

    $rent = ContactMessage::factory()
        ->create(['inquiry_type' => ContactMessageInquiryTypeEnum::RENT]);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', [
            'sort' => 'inquiryType',
            'direction' => PaginationDirection::DESC->value,
        ]))
        ->assertInertia(function (Assert $page) use ($buy, $rent): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->where('contactMessages.data.0.uuid', $rent->uuid)
                ->where('contactMessages.data.1.uuid', $buy->uuid);
        });
});

it('orders by enum fields by source.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $search = ContactMessage::factory()
        ->create(['source' => ContactMessageSourceEnum::SEARCH]);

    $social = ContactMessage::factory()
        ->create(['source' => ContactMessageSourceEnum::SOCIAL]);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', [
            'sort' => 'source',
            'direction' => PaginationDirection::DESC->value,
        ]))
        ->assertInertia(function (Assert $page) use ($search, $social): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->where('contactMessages.data.0.uuid', $social->uuid)
                ->where('contactMessages.data.1.uuid', $search->uuid);
        });
});

it('validates direction query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['direction' => 'down']))
        ->assertSessionHasErrors('direction');
});

it('validates sort query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index', ['sort' => 'id']))
        ->assertSessionHasErrors('sort');
});

it('includes inquiry types and sources with all enum values.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('inquiryTypes', count(ContactMessageInquiryTypeEnum::cases()))
                ->has('sources', count(ContactMessageSourceEnum::cases()));
        });
});

it('returns empty dataset when no records exist.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.contact-messages.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_INDEX->value)
                ->has('contactMessages.data', 0);
        });
});

it('shows a contact message.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $contactMessage = ContactMessage::factory()
        ->create(['read_at' => null]);

    $this->actingAs($user)
        ->get(route('admin.contact-messages.show', $contactMessage->uuid))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_CONTACT_MESSAGES_SHOW->value)
                ->has('contactMessage');
        });

    expect($contactMessage->fresh()->read_at)
        ->not()
        ->toBeNull();
});

it('deletes a contact message.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $contactMessage = ContactMessage::factory()
        ->create();

    $this->actingAs($user)
        ->delete(route('admin.contact-messages.destroy', $contactMessage->uuid))
        ->assertRedirectBack();

    $this->assertModelMissing($contactMessage);
});

it('bulks delete contact messages.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $contactMessages = ContactMessage::factory(2)
        ->create();

    $this->actingAs($user)
        ->post(
            route('admin.contact-messages.bulk-delete'),
            ['uuids' => $contactMessages->pluck('uuid')->toArray()],
        )->assertRedirectBack();

    $contactMessages->each(function (ContactMessage $contactMessage): void {
        $this->assertModelMissing($contactMessage);
    });
});
