<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

enum PropertyTypeEnum: string
{
    case APARTMENT = 'apartment';
    case HOUSE = 'house';
    case LOFT = 'loft';
    case VILLA = 'villa';

    /**
     * @return Collection<int, array{label: string, value: string}>
     *
     * Returns the label and value response version of all property types.
     */
    public static function toResponse(): Collection
    {
        return collect(self::cases())
            ->map(fn (self $propertyType): array => [
                'label' => $propertyType->title(),
                'value' => $propertyType->value,
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

    /*
     * Returns the plural version of the type value.
     */
    public function plural(): string
    {
        return str($this->value)
            ->plural()
            ->toString();
    }
}
