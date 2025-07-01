<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\ImageFormatEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use SplFileInfo;

final class FormatSeederImagesCommand extends Command
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
    protected $signature = 'format:seeder-images {format='.ImageFormatEnum::JPEG->value.'}}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command formats seeder images to the desired format. 
                              The default format is '.ImageFormatEnum::JPEG->value.'.';

    /*
     * Get the image format according to the file name.
     */
    private function getImageFormat(string $fileName): ImageFormatEnum
    {
        $fileFormat = str($fileName)
            ->afterLast('.')
            ->toString();

        return ImageFormatEnum::from($fileFormat);
    }

    /*
     * Format the image according to the desired format.
     */
    private function formatImage(string $pathName, ImageFormatEnum $format): void
    {
        $formattedImagePath = str($pathName)
            ->beforeLast('.')
            ->append($format->getExtension())
            ->toString();

        $encode = $format->getEncodeMethod();

        Image::read($pathName)
            ->$encode()
            ->save($formattedImagePath);

        File::delete($pathName);
    }

    /*
     * Filter the unformatted images.
     */
    private function filterUnformattedImages(string $folderPath, ImageFormatEnum $format): Collection
    {
        return collect(File::allFiles($folderPath))
            ->filter(function (SplFileInfo $file) use ($format): bool {
                return $this->getImageFormat($file->getFilename())
                    ->isNotEqualTo($format);
            });
    }

    /*
     * Format all the images according to the desired format.
     */
    private function formatImages(Collection $images, ImageFormatEnum $format): void
    {
        $bar = $this->output->createProgressBar($images->count());
        $bar->start();

        $images->each(function (SplFileInfo $file) use ($format, $bar): void {
            $this->formatImage($file->getPathname(), $format);
            $bar->advance();
        });

        $bar->finish();

        $this->successMessage = str(' images have been formatted successfully.')
            ->prepend($images->count())
            ->toString();
    }

    /*
     * Execute the console command.
     */
    public function handle(): void
    {
        $images = $this->filterUnformattedImages(
            storage_path('app/private/seeders/images'),
            $format = ImageFormatEnum::from($this->argument('format')),
        );

        if ($images->isNotEmpty()) {
            $this->formatImages($images, $format);
        }

        $this->output->success($this->successMessage);
    }
}
