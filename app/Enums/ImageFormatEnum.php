<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Stringable;
use Intervention\Image\Interfaces\EncodedImageInterface;
use Intervention\Image\Interfaces\ImageInterface;

enum ImageFormatEnum: string
{
    case AVIF = 'avif';
    case JPG = 'jpg';
    case JPEG = 'jpeg';
    case PNG = 'png';
    case WEBP = 'webp';

    /*
     * Returns true if the format is jpg.
     */
    public function isJpg(): bool
    {
        return $this === self::JPG;
    }

    /*
     * Returns true if the format is jpeg.
     */
    public function equalsTo(self $format): bool
    {
        return $this === $format;
    }

    /*
     * Returns true if the format is not equal to the given format.
     */
    public function isNotEqualTo(self $format): bool
    {
        return ! $this->equalsTo($format);
    }

    /*
     * Returns the format in upper case.
     */
    public function toUpper(): string
    {
        return str($this->value)
            ->upper()
            ->toString();
    }

    /*
     * Returns the encode method for the given image.
     */
    public function getEncodeMethod(ImageInterface $image): EncodedImageInterface
    {
        return match ($this) {
            self::AVIF => $image->toAvif(),
            self::JPG, self::JPEG => $image->toJpeg(),
            self::PNG => $image->toPng(),
            self::WEBP => $image->toWebp(),
        };
    }

    /*
     * Returns the extension for the format.
     */
    public function getExtension(): string
    {
        return str($this->value)
            ->when(
                $this->isJpg(),
                fn (): Stringable => str(self::JPEG->value)
            )
            ->prepend('.')
            ->toString();
    }
}
