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

it('updates a whole profile with all thumbnail formats.', function (array $data, ImageFormatEnum $format): void {
    Storage::fake('users')
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
        ->not->toBeNull();

    if (isset($data['name'])) {
        expect($updatedUser->name)
            ->toBe($data['name']);
    }

    if (isset($data['password'])) {
        expect(Hash::check($data['password'], $updatedUser->password))
            ->toBeTrue();
    }

    Storage::disk('users')
        ->assertCount('thumbnails', 1);
})->with([
    [['name' => fake()->name()]],
    [['name' => fake()->name(), 'password' => $password = fake()->password(10), 'password_confirmation' => $password]],
])->with(ImageFormatEnum::eachAsArray());
