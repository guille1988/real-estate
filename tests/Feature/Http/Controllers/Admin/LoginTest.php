<?php

declare(strict_types=1);

use App\Models\User;

it('works on login page.', function (): void {
    $this->get(route('admin.login.create'))
        ->assertOk();
});

it('logs in successfully with valid credentials and redirects to dashboard.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->post(route('admin.login.store'), [
        'email' => $user->email,
        'password' => config()->string('app.admin_password'),
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($user);
});

it('fails to login with invalid credentials and returns back with errors keeping old email.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->from(route('admin.login.create'))
        ->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'invalid-password',
        ])
        ->assertRedirect(route('admin.login.create'))
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('logs out and redirects to login page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->delete(route('admin.login.destroy'))
        ->assertRedirect(route('admin.login.create'));

    $this->assertGuest();
});
