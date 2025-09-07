<?php

declare(strict_types=1);

use App\Models\Subscriber;

it('subscribes.', function (string $email): void {
    $this->post(route('subscribers'), compact('email'))
        ->assertRedirect();

    expect(Subscriber::count())
        ->toBe(1);
})->with([fake()->unique()->safeEmail()]);
