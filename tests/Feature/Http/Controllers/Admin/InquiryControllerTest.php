<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Models\Inquiry;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.inquiries.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries');
        });
});

it('works with page query string.', function (): void {
    $perPage = 9;

    $user = User::factory()
        ->admin()
        ->create();

    Inquiry::factory($perPage + 1)->create();

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', ['page' => 2]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries.data', 1);
        });
});

it('validates page query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', ['page' => 'abc']))
        ->assertSessionHasErrors('page');
});

it('works with search query string for first name, last name and email.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Inquiry::factory()
        ->create(['first_name' => 'AdminTest Alpha']);

    Inquiry::factory()
        ->create(['last_name' => 'AdminTest Beta']);

    Inquiry::factory()
        ->create(['email' => 'admintest@example.com']);

    Inquiry::factory()
        ->create(['first_name' => 'Gamma']);

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', ['search' => 'AdminTest']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries.data', 3);
        });
});

it('filters by read flag true.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $read = Inquiry::factory()
        ->create(['read_at' => now()]);

    Inquiry::factory()
        ->create(['read_at' => null]);

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', ['read' => true]))
        ->assertInertia(function (Assert $page) use ($read): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries.data', 1)
                ->where('inquiries.data.0.uuid', $read->uuid)
                ->where('inquiries.data.0.readAt', $read->read_at->toDateTimeString());
        });
});

it('filters by read flag false.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Inquiry::factory()
        ->create(['read_at' => now()]);

    $unread = Inquiry::factory()
        ->create(['read_at' => null]);

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', ['read' => false]))
        ->assertInertia(function (Assert $page) use ($unread): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries.data', 1)
                ->where('inquiries.data.0.uuid', $unread->uuid)
                ->where('inquiries.data.0.readAt', null);
        });
});

it('orders by default id asc when sort is not provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = Inquiry::factory()
        ->create(['first_name' => 'Zeta']);

    $second = Inquiry::factory()
        ->create(['first_name' => 'Alpha']);

    $this->actingAs($user)
        ->get(route('admin.inquiries.index'))
        ->assertInertia(function (Assert $page) use ($first, $second): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries.data', 2)
                ->where('inquiries.data.0.uuid', $first->uuid)
                ->where('inquiries.data.1.uuid', $second->uuid);
        });
});

it('orders by id desc when direction is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = Inquiry::factory()
        ->create(['first_name' => 'Zeta']);

    $second = Inquiry::factory()
        ->create(['first_name' => 'Alpha']);

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', ['direction' => PaginationDirection::DESC->value]))
        ->assertInertia(function (Assert $page) use ($first, $second): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries.data', 2)
                ->where('inquiries.data.0.uuid', $second->uuid)
                ->where('inquiries.data.1.uuid', $first->uuid);
        });
});

it('validates direction query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', ['direction' => 'down']))
        ->assertSessionHasErrors('direction');
});

it('validates sort query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', ['sort' => 'id']))
        ->assertSessionHasErrors('sort');
});

it('orders by firstName asc when sort is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = Inquiry::factory()
        ->create(['first_name' => 'Alpha']);

    $zeta = Inquiry::factory()
        ->create(['first_name' => 'Zeta']);

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', ['sort' => 'firstName']))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries.data', 2)
                ->where('inquiries.data.0.uuid', $alpha->uuid)
                ->where('inquiries.data.1.uuid', $zeta->uuid);
        });
});

it('orders by lastName desc when sort and direction are provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = Inquiry::factory()
        ->create(['last_name' => 'Alpha']);

    $zeta = Inquiry::factory()
        ->create(['last_name' => 'Zeta']);

    $this->actingAs($user)
        ->get(route('admin.inquiries.index', [
            'sort' => 'lastName',
            'direction' => PaginationDirection::DESC->value,
        ]))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries.data', 2)
                ->where('inquiries.data.0.uuid', $zeta->uuid)
                ->where('inquiries.data.1.uuid', $alpha->uuid);
        });
});

it('returns empty dataset when no records exist.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.inquiries.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_INDEX->value)
                ->has('inquiries.data', 0);
        });
});

it('shows an inquiry.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $inquiry = Inquiry::factory()
        ->unread()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.inquiries.show', $inquiry->uuid))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_INQUIRIES_SHOW->value)
                ->has('inquiry');
        });

    expect($inquiry->fresh()->read_at)
        ->not()
        ->toBeNull();
});

it('deletes an inquiry.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $inquiry = Inquiry::factory()
        ->create();

    $this->actingAs($user)
        ->delete(route('admin.inquiries.destroy', $inquiry->uuid))
        ->assertRedirectBack();

    $this->assertModelMissing($inquiry);
});

it('bulks delete inquiries.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $inquiries = Inquiry::factory(2)
        ->create();

    $this->actingAs($user)
        ->post(
            route('admin.inquiries.bulk-delete'),
            ['uuids' => $inquiries->pluck('uuid')->toArray()],
        )->assertRedirectBack();

    $inquiries->each(function (Inquiry $inquiry): void {
        $this->assertModelMissing($inquiry);
    });
});
