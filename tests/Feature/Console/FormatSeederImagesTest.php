<?php

declare(strict_types=1);

use App\Enums\ImageFormatEnum;
use Symfony\Component\Finder\SplFileInfo;

it('formats seeder images.', function (ImageFormatEnum $format): void {
    $basePath = base_path('tests/Fixtures/Jobs/format_seeder_images/default_images');
    $path = base_path('tests/Fixtures/Jobs/format_seeder_images/images');

    File::copyDirectory($basePath, $path);

    $this->artisan('format:seeder-images', [
        '--path' => $path,
        '--format' => $format->value,
    ])->assertSuccessful();

    $isProperFormat = collect(File::allFiles($path))
        ->every(function (SplFileInfo $file) use ($format): bool {
            return str($file->getFilename())
                ->endsWith($format->getExtension());
        });

    expect($isProperFormat)->toBeTrue();

    File::deleteDirectory($path);
})->with(ImageFormatEnum::cases());

it("doesn't perform formatting if there are no images to format.", function (): void {
    $format = ImageFormatEnum::AVIF;
    $basePath = base_path('tests/Fixtures/Jobs/format_seeder_images/default_images');
    $path = base_path('tests/Fixtures/Jobs/format_seeder_images/images');

    File::copyDirectory($basePath, $path);

    collect(File::allFiles($path))
        ->each(function (SplFileInfo $file): void {
            File::delete($file->getPathname());
        });

    $this->artisan('format:seeder-images', [
        '--path' => $path,
        '--format' => $format->value,
    ])
        ->assertSuccessful()
        ->expectsOutputToContain('There are no images to format.');

    File::deleteDirectory($path);
});

it("doesn't perform formatting if all images are of the same destination format.", function (): void {
    $format = ImageFormatEnum::JPEG;
    $basePath = base_path('tests/Fixtures/Jobs/format_seeder_images/default_images');
    $path = base_path('tests/Fixtures/Jobs/format_seeder_images/images');

    File::copyDirectory($basePath, $path);

    $this->artisan('format:seeder-images', [
        '--path' => $path,
        '--format' => $format->value,
    ])
        ->assertSuccessful()
        ->expectsOutputToContain('There are no images to format.');

    File::deleteDirectory($path);
});

it("doesn't perform formatting if one image has an unsupported format.", function (): void {
    $basePath = base_path('tests/Fixtures/Jobs/format_seeder_images/default_images');
    $path = base_path('tests/Fixtures/Jobs/format_seeder_images/images');

    File::copyDirectory($basePath, $path);
    File::put("$path/fail.txt", 'Failed content.');

    $this->artisan('format:seeder-images', [
        '--path' => $path,
    ])
        ->assertFailed()
        ->expectsOutputToContain('has a format that is not supported.');

    File::deleteDirectory($path);
});

it('should fail due to invalid path.', function (): void {
    $this->artisan('format:seeder-images', [
        '--path' => 'invalid/path',
    ])
        ->expectsOutputToContain("The path must be a path inside the project's directory.")
        ->assertFailed();
});

it('should fail due to invalid format.', function (): void {
    $this->artisan('format:seeder-images', [
        '--format' => 'invalid',
        '--path' => base_path('tests/Fixtures/Jobs/format_seeder_images/images'),
    ])
        ->assertFailed()
        ->expectsOutputToContain('The selected format is invalid.');
});
