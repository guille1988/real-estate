<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

enum ContactMessageInquiryTypeEnum: string
{
    case BUY = 'buy';
    case SELL = 'sell';
    case RENT = 'rent';
    case OTHER = 'other';

    /**
     * @return Collection<int, array{label: string, value: string}>
     *
     * Returns the label and value response version of all inquiry types.
     */
    public static function toResponse(): Collection
    {
        return collect(self::cases())
            ->map(fn (self $inquiryType): array => [
                'label' => $inquiryType->title(),
                'value' => $inquiryType->value,
            ]);
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
