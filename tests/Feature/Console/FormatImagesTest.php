<?php

declare(strict_types=1);

use App\Enums\ImageFormatEnum;
use Symfony\Component\Finder\SplFileInfo;

beforeEach(function (): void {
    File::deleteDirectory(
        base_path('tests/Fixtures/Commands/format_images/images')
    );
});

it('formats images.', function (ImageFormatEnum $format): void {
    $basePath = base_path('tests/Fixtures/Commands/format_images/default_images');
    $path = base_path('tests/Fixtures/Commands/format_images/images');

    File::copyDirectory($basePath, $path);

    $this->artisan('format:images', [
        '--path' => $path,
        '--format' => $format->value,
    ])->assertSuccessful();

    $isProperFormat = collect(File::allFiles($path))
        ->every(function (SplFileInfo $file) use ($format): bool {
            return str($file->getFilename())
                ->endsWith($format->getExtension());
        });

    expect($isProperFormat)->toBeTrue();
})->with(ImageFormatEnum::cases());

it("doesn't perform formatting if there are no images to format.", function (): void {
    $format = ImageFormatEnum::AVIF;
    $basePath = base_path('tests/Fixtures/Commands/format_images/default_images');
    $path = base_path('tests/Fixtures/Commands/format_images/images');

    File::copyDirectory($basePath, $path);

    collect(File::allFiles($path))
        ->each(function (SplFileInfo $file): void {
            File::delete($file->getPathname());
        });

    $this->artisan('format:images', [
        '--path' => $path,
        '--format' => $format->value,
    ])
        ->assertSuccessful()
        ->expectsOutputToContain('There are no images to format.');
});

it("doesn't perform formatting if all images are of the same destination format.", function (): void {
    $format = ImageFormatEnum::JPEG;
    $basePath = base_path('tests/Fixtures/Commands/format_images/default_images');
    $path = base_path('tests/Fixtures/Commands/format_images/images');

    File::copyDirectory($basePath, $path);

    $this->artisan('format:images', [
        '--path' => $path,
        '--format' => $format->value,
    ])
        ->assertSuccessful()
        ->expectsOutputToContain('There are no images to format.');
});

it('ignores files.', function (): void {
    $basePath = base_path('tests/Fixtures/Commands/format_images/default_images');
    $path = base_path('tests/Fixtures/Commands/format_images/images');

    File::copyDirectory($basePath, $path);
    File::put($fileName = "$path/fail.txt", 'Failed content.');

    $this->artisan('format:images', [
        '--path' => $path,
        '--format' => ImageFormatEnum::JPEG->value,
    ])->assertSuccessful();

    expect(File::exists($fileName))
        ->toBeTrue();
});

it('should fail due to invalid path.', function (): void {
    $this->artisan('format:images', [
        '--path' => 'invalid/path',
        '--format' => ImageFormatEnum::JPEG->value,
    ])
        ->expectsOutputToContain("The path must be a path inside the project's directory.")
        ->assertFailed();
});

it('should fail due to invalid format.', function (): void {
    $this->artisan('format:images', [
        '--format' => 'invalid',
        '--path' => base_path('tests/Fixtures/Commands/format_images/images'),
    ])
        ->assertFailed()
        ->expectsOutputToContain('The selected format is invalid.');
});
