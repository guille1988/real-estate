<?php

declare(strict_types=1);

use App\Enums\PageEnum;
use App\Enums\PaginationDirection;
use App\Models\Image;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;

it('works on index page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Image::factory($perPage = 7)->create();

    $this->actingAs($user)
        ->get(route('admin.images.index'))
        ->assertInertia(function (Assert $page) use ($perPage): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images')
                ->has('images.data', $perPage);
        });
});

it('works with page query string.', function (): void {
    $perPage = 7;

    $user = User::factory()
        ->admin()
        ->create();

    Image::factory($perPage + 1)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.images.index', ['page' => 2]))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images.data', 1);
        });
});

it('works with search query string (by related property title).', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $matchingOne = Property::factory()
        ->create(['title' => 'AdminTest Alpha']);

    $matchingTwo = Property::factory()
        ->create(['title' => 'AdminTest Beta']);

    $nonMatching = Property::factory()
        ->create(['title' => 'Gamma']);

    Image::factory()->for($matchingOne)->create();
    Image::factory()->for($matchingTwo)->create();
    Image::factory()->for($nonMatching)->create();

    $this->actingAs($user)
        ->get(route('admin.images.index', ['search' => 'AdminTest']))
        ->assertInertia(function (Assert $page): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images.data', 2);
        });
});

it('works with is default true query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Image::factory($count = 2)
        ->default()
        ->create();

    Image::factory()
        ->notDefault()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.images.index', ['isDefault' => true]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images.data', $count);
        });
});

it('works with is default false query string.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Image::factory($count = 2)
        ->notDefault()
        ->create();

    Image::factory()
        ->default()
        ->create();

    $this->actingAs($user)
        ->get(route('admin.images.index', ['is_default' => false]))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->has('images.data', $count);
        });
});

it('works with sort created at and direction asc query strings.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $older = Image::factory()
        ->create(['created_at' => now()->subDays(2)]);

    $middle = Image::factory()
        ->create(['created_at' => now()->subDay()]);

    $newer = Image::factory()
        ->create(['created_at' => now()]);

    $this->actingAs($user)
        ->get(route('admin.images.index', ['sort' => 'createdAt', 'direction' => PaginationDirection::ASC->value]))
        ->assertInertia(function (Assert $page) use ($older, $middle, $newer): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->where('images.data.0.uuid', $older->uuid)
                ->where('images.data.1.uuid', $middle->uuid)
                ->where('images.data.2.uuid', $newer->uuid);
        });
});

it('works with sort updated at and direction desc query strings.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    $first = Image::factory()
        ->create(['updated_at' => now()->subDays(2)]);

    $second = Image::factory()
        ->create(['updated_at' => now()->subDay()]);

    $third = Image::factory()
        ->create(['updated_at' => now()]);

    $this->actingAs($user)
        ->get(route('admin.images.index', ['sort' => 'updatedAt', 'direction' => PaginationDirection::DESC->value]))
        ->assertInertia(function (Assert $page) use ($first, $second, $third): void {
            $page->component(PageEnum::ADMIN_IMAGES_INDEX->value)
                ->where('images.data.0.uuid', $third->uuid)
                ->where('images.data.1.uuid', $second->uuid)
                ->where('images.data.2.uuid', $first->uuid);
        });
});

it('works showing create images page.', function (): void {
    $user = User::factory()
        ->admin()
        ->create();

    Property::factory($count = 10)
        ->create();

    $this->actingAs($user)
        ->get(route('admin.images.create'))
        ->assertInertia(function (Assert $page) use ($count): void {
            $page->component(PageEnum::ADMIN_IMAGES_CREATE->value)
                ->has('properties', $count);
        });
});

it('stores images and marks one as default, moving files and clearing cache.', function (): void {
    Artisan::shouldReceive('call')
        ->once()
        ->with('format:images', Mockery::any())
        ->andReturn(0);

    Storage::fake('tmp');
    Storage::fake('images');

    $user = User::factory()
        ->admin()
        ->create();

    $property = Property::factory()
        ->create();

    cache()->put('foo', 'bar');

    $payload = [
        'property' => $property->uuid,
        'images' => [
            ['file' => UploadedFile::fake()->image('a.jpeg')->size(500), 'is_default' => true],
            ['file' => UploadedFile::fake()->image('b.jpeg')->size(500), 'is_default' => false],
        ],
    ];

    $this->from(route('admin.images.create'))
        ->actingAs($user)
        ->post(route('admin.images.store'), $payload)
        ->assertRedirect(route('admin.images.create'));

    $destination = $property->getDestinationPath();

    Storage::disk('tmp')
        ->assertMissing($property->uuid);

    $files = Storage::disk('images')
        ->allFiles($destination);

    expect($files)
        ->toHaveCount(2)
        ->and($images = $property->images()->get())
        ->toHaveCount(2)
        ->and($images->filter->isDefault()->count())
        ->toBe(1)
        ->and($images->filter->isNotDefault()->count())
        ->toBe(1);

    foreach ($images as $image) {
        expect($image->path)
            ->toStartWith("$destination/");

        Storage::disk('images')
            ->assertExists($image->path);
    }

    expect(cache()->has('foo'))
        ->toBeFalse();
});

it('validates request data for store: requires property and images, with one default.', function (): void {
    Storage::fake('tmp');

    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user)
        ->post(route('admin.images.store'))
        ->assertSessionHasErrors(['property', 'images']);

    $property = Property::factory()
        ->create();

    $extension = config('app.default_image_format');

    $firstImage = UploadedFile::fake()
        ->image("a.$extension")
        ->size(500);

    $secondImage = UploadedFile::fake()
        ->image("b.$extension")
        ->size(500);

    $payload = [
        'property' => $property->uuid,
        'images' => [
            ['file' => $firstImage, 'is_default' => false],
            ['file' => $secondImage, 'is_default' => false],
        ],
    ];

    $this->actingAs($user)
        ->post(route('admin.images.store'), $payload)
        ->assertSessionHasErrors(['images']);

    $thirdImage = UploadedFile::fake()
        ->create('c.txt', 10, 'text/plain');

    $payload['images'][1]['is_default'] = true;
    $payload['images'][] = ['file' => $thirdImage, 'is_default' => false];

    $this->actingAs($user)
        ->post(route('admin.images.store'), $payload)
        ->assertSessionHasErrors(['images.2.file']);

    $payload = [
        'property' => 'non-existent-uuid',
        'images' => [
            ['file' => $firstImage, 'is_default' => true],
        ],
    ];

    $this->actingAs($user)
        ->post(route('admin.images.store'), $payload)
        ->assertSessionHasErrors(['property']);
});

it('rolls back and cleans up when an error occurs during file copy.', function (): void {
    Artisan::shouldReceive('call')
        ->once()
        ->with('format:images', Mockery::any())
        ->andReturn(0);

    Storage::fake('tmp');
    Storage::fake('images');

    $user = User::factory()
        ->admin()
        ->create();

    $property = Property::factory()
        ->create();

    File::shouldReceive('copyDirectory')
        ->andThrow(new RuntimeException);

    $extension = config('app.default_image_format');

    $file = UploadedFile::fake()
        ->image("a.$extension")
        ->size(500);

    $payload = [
        'property' => $property->uuid,
        'images' => [
            ['file' => $file, 'is_default' => true],
        ],
    ];

    try {
        $failMessage = 'Expected exception was not thrown.';

        $this->actingAs($user)
            ->post(route('admin.images.store'), $payload);

        $this->fail($failMessage);
    } catch (Throwable $exception) {
        expect($exception->getMessage())
            ->toBe($failMessage);
    }

    Storage::disk('tmp')
        ->assertMissing($property->uuid);

    Storage::disk('images')
        ->assertMissing($property->uuid);

    expect($property->images()->count())
        ->toBe(0);
});
