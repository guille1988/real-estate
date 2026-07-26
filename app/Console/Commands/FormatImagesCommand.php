<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\ImageFormatEnum;
use App\Rules\IsValidPath;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\LazyCollection;
use Illuminate\Validation\Rule;
use Symfony\Component\Finder\SplFileInfo;
use Throwable;

final class FormatImagesCommand extends Command
{
    private string $successMessage = 'There are no images to format.' {
        get {
            return $this->successMessage;
        }
        set {
            $this->successMessage = $value;
        }
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'format:images {--format=} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command formats images to the desired format given a path.';

    /**
     * Validates the command input options.
     *
     * @param  array<string,string>  $options
     *
     * @throws Throwable
     */
    private function validateInput(array $options): void
    {
        $validator = validator($options, [
            'format' => ['required', 'string', Rule::enum(ImageFormatEnum::class)],
            'path' => ['required', 'string', new IsValidPath],
        ]);

        if ($validator->fails()) {
            $this->fail($validator->errors()->first());
        }
    }

    /**
     * Main method to process and format seeder images.
     * Determines the target format and path, then
     * processes all unformatted images.
     *
     * @param  array<string,string>  $options
     */
    private function formatSeederImages(array $options): void
    {
        $format = ImageFormatEnum::from($options['format']);
        $this->startMessage($format->toUpper());

        $images = $this->filterUnformattedImages($options['path'], $format);

        if ($images->isNotEmpty()) {
            $this->formatImages($images, $format);
        }

        $this->outputSuccessMessage();
    }

    /**
     * Displays the starting message for the image formatting process.
     */
    private function startMessage(string $format): void
    {
        $this->newLine();
        $this->info(sprintf('Formatting images to %s format...', $format));
    }

    /*
     * Checks if the given path is an image.
     */
    private function isImage(string $path): bool
    {
        return @getimagesize($path) !== false;
    }

    /**
     * First, filter files that are images and not files.
     * Then, filter images that are already in the desired format.
     *
     * @return LazyCollection<int, SplFileInfo>
     */
    private function filterUnformattedImages(string $folderPath, ImageFormatEnum $format): LazyCollection
    {
        return LazyCollection::make(File::allFiles($folderPath))
            ->filter(function (SplFileInfo $file): bool {
                return $this->isImage($file->getPathname());
            })->filter(function (SplFileInfo $file) use ($format): bool {
                return $this->getImageFormat($file->getPathname())
                    ->isNotEqualTo($format);
            });
    }

    /**
     * Gets the image format according to the file name.
     *
     * @throws Throwable
     */
    private function getImageFormat(string $path): ImageFormatEnum
    {
        $imageFormat = str($path)
            ->afterLast('.')
            ->toString();

        return ImageFormatEnum::from($imageFormat);
    }

    /**
     * Format all the images according to the desired format.
     *
     * @param  LazyCollection<int, SplFileInfo>  $images
     */
    private function formatImages(LazyCollection $images, ImageFormatEnum $format): void
    {
        $this->newLine();

        $bar = $this->output->createProgressBar($count = $images->count());
        $bar->start();

        $images->each(function (SplFileInfo $file) use ($format, $bar): void {
            $this->formatImage($file->getPathname(), $format);
            $bar->advance();
        });

        $bar->finish();

        $this->successMessage = str('image')
            ->plural($count > 1 ? 2 : 1)
            ->prepend("$count ")
            ->append(' have been formatted successfully.')
            ->toString();
    }

    /**
     * Formats the image according to the desired format.
     */
    private function formatImage(string $path, ImageFormatEnum $format): void
    {
        $image = str($path)
            ->beforeLast('.')
            ->append($format->getExtension())
            ->toString();

        File::put(
            $image,
            $format->getEncodeMethod(Image::fromPath($path))->toBytes(),
        );

        File::delete($path);
    }

    /*
     * Displays the success message after the image formatting process.
     * Uses the stored success message to provide feedback to the user.
     */
    private function outputSuccessMessage(): void
    {
        $this->newLine(2);
        $this->output->success($this->successMessage);
    }

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(): void
    {
        /**
         * @var array<string,string> $options
         */
        $options = $this->options();

        $this->validateInput($options);
        $this->formatSeederImages($options);
    }
}
