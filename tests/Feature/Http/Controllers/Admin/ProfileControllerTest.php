<?php

declare(strict_types=1);

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

it('updates a whole profile with thumbnail with non-default format.', function (array $data): void {
    Storage::fake('users')
        ->makeDirectory('thumbnails');

    $thumbnail = UploadedFile::fake()
        ->image('avatar.jpg');

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
        ->toBe($data['name'])
        ->and(Hash::check($data['password'], $updatedUser->password))
        ->toBeTrue();

    Storage::disk('users')
        ->assertCount('thumbnails', 1);
})->with([
    [
        [
            'name' => 'Test',
            'password' => 'Test password',
            'password_confirmation' => 'Test password',
        ],
    ],
]);


