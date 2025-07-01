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

    public function isJpg(): bool
    {
        return $this === self::JPG;
    }

    public function equalsTo(self $format): bool
    {
        return $this === $format;
    }

    public function isNotEqualTo(self $format): bool
    {
        return ! $this->equalsTo($format);
    }

    public function getEncodeMethod(ImageInterface $image): EncodedImageInterface
    {
        return match ($this) {
            self::AVIF => $image->toAvif(),
            self::JPG, self::JPEG => $image->toJpeg(),
            self::PNG => $image->toPng(),
            self::WEBP => $image->toWebp(),
        };
    }

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
