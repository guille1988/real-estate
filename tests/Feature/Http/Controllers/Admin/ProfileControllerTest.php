<?php

declare(strict_types=1);

use App\Enums\ImageFormatEnum;
use App\Models\User;
use Illuminate\Http\UploadedFile;

it('displays profile page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.profile.edit'))
        ->assertOk();
});

it("doesn't update if the password is the same.", function (): void {
    $data = [
        'name' => fake()->name(),
        'password' => $password = config()->string('app.admin_password'),
        'password_confirmation' => $password,
    ];

    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->patch(route('admin.profile.update'), $data)
        ->assertSessionHasErrors('password');
});

it('updates profile without thumbnail.', function (array $data): void {
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->patch(route('admin.profile.update'), $data)
        ->assertRedirectBack();

    $updatedUser = $user->fresh();

    expect($updatedUser->thumbnail)
        ->toBeNull()
        ->and($updatedUser->name)
        ->toBe($data['name']);

    if (isset($data['password'])) {
        expect(Hash::check($data['password'], $updatedUser->password))
            ->toBeTrue();
    }
})->with([
    [
        [
            'name' => fake()->name(),
        ],
        [
            'name' => fake()->name(),
            'password' => $password = fake()->password(10),
            'password_confirmation' => $password,
        ],
    ],
]);

it('updates profile with all thumbnail formats.', function (array $data, ImageFormatEnum $format): void {
    Storage::fake('users');

    Storage::disk('users')
        ->makeDirectory('thumbnails');

    $thumbnail = UploadedFile::fake()
        ->image("avatar.$format->value");

    $data['thumbnail'] = $thumbnail;

    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->patch(route('admin.profile.update'), $data)
        ->assertRedirectBack();

    $updatedUser = $user->fresh();

    expect($updatedUser->thumbnail)
        ->not->toBeNull()
        ->and($updatedUser->name)
        ->toBe($data['name']);

    if (isset($data['password'])) {
        expect(Hash::check($data['password'], $updatedUser->password))
            ->toBeTrue();
    }

    Storage::disk('users')
        ->assertCount('thumbnails', 1);
})->with([
    [
        [
            'name' => fake()->name(),
        ],
    ],
    [
        [
            'name' => fake()->name(),
            'password' => $password = fake()->password(10),
            'password_confirmation' => $password,
        ],
    ],
])->with(ImageFormatEnum::eachAsArray());

it('updates profile with all thumbnail formats with previous thumbnail saved.', function (array $data, ImageFormatEnum $format): void {
    Storage::fake('users');

    Storage::disk('users')
        ->makeDirectory('thumbnails');

    $thumbnail = UploadedFile::fake()
        ->image("avatar.$format->value");

    $data['thumbnail'] = $thumbnail;

    $user = User::factory()
        ->admin()
        ->create(['thumbnail' => $path = 'thumbnails/test.txt']);

    Storage::disk('users')
        ->put($path, 'test');

    $this->actingAs($user->fresh())
        ->patch(route('admin.profile.update'), $data)
        ->assertRedirectBack();

    $updatedUser = $user->fresh();

    expect($updatedUser->thumbnail)
        ->not->toBeNull()
        ->and($updatedUser->name)
        ->toBe($data['name']);

    if (isset($data['password'])) {
        expect(Hash::check($data['password'], $updatedUser->password))
            ->toBeTrue();
    }

    Storage::disk('users')
        ->assertCount('thumbnails', 1);
})->with([
    [
        [
            'name' => fake()->name(),
        ],
    ],
    [
        [
            'name' => fake()->name(),
            'password' => $password = fake()->password(10),
            'password_confirmation' => $password,
        ],
    ],
])->with(ImageFormatEnum::eachAsArray());
