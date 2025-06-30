<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Stringable;

enum ImageFormatEnum: string
{
    case AVIF = 'avif';
    case BMP = 'bmp';
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

    public function getEncodeMethod(): string
    {
        return str($this->value)
            ->when(
                $this->isJpg(),
                fn (): Stringable => str(self::JPEG->value)
            )
            ->ucfirst()
            ->prepend('to')
            ->toString();
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
