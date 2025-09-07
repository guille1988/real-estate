<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

enum InquiryTypeEnum: string
{
    case BUY = 'buy';
    case SELL = 'sell';
    case RENT = 'rent';
    case OTHER = 'other';

    /**
     * @return Collection<string, string>
     *
     * Returns a collection of inquiry types with their title versions.
     */
    public static function toResponse(): Collection
    {
        return collect(self::cases())
            ->flatMap(function (self $inquiryType): array {
                return [$inquiryType->value => $inquiryType->title()];
            });
    }

    /*
     * Returns the title version of the type value.
     */
    public function title(): string
    {
        return str($this->value)
            ->replace('_', ' ')
            ->title()
            ->toString();
    }
}
