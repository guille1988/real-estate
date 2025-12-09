<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Models\Subscriber;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.subscribers.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_SUBSCRIBERS_INDEX->value)
                ->has('subscribers');
        });
});

it('works with page query string.', function (): void {
    $perPage = 10;

    $user = User::factory()
        ->admin()
        ->create();

    Subscriber::factory($perPage + 1)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.subscribers.index', ['page' => 2]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_SUBSCRIBERS_INDEX->value)
                ->has('subscribers.data', 1);
        });
});

it('validates page query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.subscribers.index', ['page' => 'abc']))
        ->assertSessionHasErrors('page');
});

it('works with search query string for email.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Subscriber::factory()
        ->create(['email' => 'admin-test.alpha@example.com']);

    Subscriber::factory()
        ->create(['email' => 'admin-test.beta@example.com']);

    Subscriber::factory()
        ->create(['email' => 'other@example.com']);

    $this->actingAs($user)
        ->get(route('admin.subscribers.index', ['search' => 'admin-test']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_SUBSCRIBERS_INDEX->value)
                ->has('subscribers.data', 2);
        });
});

it('orders by default id asc when sort is not provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = Subscriber::factory()
        ->create(['email' => 'zeta@example.com']);

    $second = Subscriber::factory()
        ->create(['email' => 'alpha@example.com']);

    $this->actingAs($user)
        ->get(route('admin.subscribers.index'))
        ->assertInertia(function (Assert $page) use ($first, $second): void {
            $page->component(PageEnum::ADMIN_SUBSCRIBERS_INDEX->value)
                ->has('subscribers.data', 2)
                ->where('subscribers.data.0.uuid', $first->uuid)
                ->where('subscribers.data.1.uuid', $second->uuid);
        });
});

it('orders by id desc when direction is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = Subscriber::factory()
        ->create(['email' => 'zeta@example.com']);

    $second = Subscriber::factory()
        ->create(['email' => 'alpha@example.com']);

    $this->actingAs($user)
        ->get(route('admin.subscribers.index', ['direction' => PaginationDirection::DESC->value]))
        ->assertInertia(function (Assert $page) use ($first, $second): void {
            $page->component(PageEnum::ADMIN_SUBSCRIBERS_INDEX->value)
                ->has('subscribers.data', 2)
                ->where('subscribers.data.0.uuid', $second->uuid)
                ->where('subscribers.data.1.uuid', $first->uuid);
        });
});

it('validates direction query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.subscribers.index', ['direction' => 'down']))
        ->assertSessionHasErrors('direction');
});

it('validates sort query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.subscribers.index', ['sort' => 'id']))
        ->assertSessionHasErrors('sort');
});

it('orders by email asc when sort is provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = Subscriber::factory()
        ->create(['email' => 'alpha@example.com']);

    $zeta = Subscriber::factory()
        ->create(['email' => 'zeta@example.com']);

    $this->actingAs($user)
        ->get(route('admin.subscribers.index', ['sort' => 'email']))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_SUBSCRIBERS_INDEX->value)
                ->has('subscribers.data', 2)
                ->where('subscribers.data.0.uuid', $alpha->uuid)
                ->where('subscribers.data.1.uuid', $zeta->uuid);
        });
});

it('orders by email desc when sort and direction are provided.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $alpha = Subscriber::factory()
        ->create(['email' => 'alpha@example.com']);

    $zeta = Subscriber::factory()
        ->create(['email' => 'zeta@example.com']);

    $this->actingAs($user)
        ->get(route('admin.subscribers.index', [
            'sort' => 'email',
            'direction' => PaginationDirection::DESC->value,
        ]))
        ->assertInertia(function (Assert $page) use ($alpha, $zeta): void {
            $page->component(PageEnum::ADMIN_SUBSCRIBERS_INDEX->value)
                ->has('subscribers.data', 2)
                ->where('subscribers.data.0.uuid', $zeta->uuid)
                ->where('subscribers.data.1.uuid', $alpha->uuid);
        });
});

it('returns empty dataset when no records exist.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.subscribers.index'))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_SUBSCRIBERS_INDEX->value)
                ->has('subscribers.data', 0);
        });
});

it('deletes a subscriber.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $subscriber = Subscriber::factory()
        ->create();

    $this->actingAs($user)
        ->delete(route('admin.subscribers.destroy', $subscriber->uuid))
        ->assertRedirectBack();

    $this->assertModelMissing($subscriber);
});

it('bulks delete subscribers.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $subscribers = Subscriber::factory(2)
        ->create();

    $this->actingAs($user)
        ->post(
            route('admin.subscribers.bulk-delete'),
            ['uuids' => $subscribers->pluck('uuid')->toArray()],
        )->assertRedirectBack();

    $subscribers->each(function (Subscriber $subscriber): void {
        $this->assertModelMissing($subscriber);
    });
});
