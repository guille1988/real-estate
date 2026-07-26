<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Image\Image;
use Illuminate\Support\Stringable;

enum ImageFormatEnum: string
{
    case AVIF = 'avif';
    case JPG = 'jpg';
    case JPEG = 'jpeg';
    case PNG = 'png';
    case WEBP = 'webp';

    /**
     * Returns all the values of the enum.
     *
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_map(
            fn (self $case): string => $case->value,
            self::cases(),
        );
    }

    /**
     * Returns each enum as an array.
     *
     * This method is ignored in code coverage
     * because it is not used in the application,
     * only on the tests.
     *
     * @return array<int, array{self}>
     *
     * @codeCoverageIgnore
     */
    public static function eachAsArray(): array
    {
        return array_map(
            fn (self $case): array => [$case],
            self::cases(),
        );
    }

    /*
     * Returns true if the format is jpg.
     */
    public function isJpg(): bool
    {
        return $this === self::JPG;
    }

    /*
     * Returns true if the format is equal to the given format.
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
     * Returns true if the format value is equal to the given format.
     */
    public function valueEqualsToLowered(string $format): bool
    {
        return $this->value === mb_strtolower($format);
    }

    /*
     * Returns the format in uppercase.
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
    public function getEncodeMethod(Image $image): Image
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
