<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Stringable;

enum PropertyAreaRangeEnum: string
{
    case BETWEEN_500_AND_1000 = '500-1000';
    case BETWEEN_1_000_AND_1_500 = '1000-1500';
    case BETWEEN_1_500_AND_2_000 = '1500-2000';
    case BETWEEN_2_000_AND_3_000 = '2000-3000';
    case MORE_THAN_3_000 = '3000-plus';

    /**
     * @return Collection<int, array{label: string, value: string}>
     *
     * Returns the label and value response version of all area ranges.
     */
    public static function toResponse(): Collection
    {
        return collect(self::cases())
            ->map(fn (self $case): array => [
                'label' => $case->getLabel(),
                'value' => $case->value,
            ]);
    }

    /*
     * Returns the label version of the area range value.
     */
    public function getLabel(): string
    {
        $label = str($this->value)
            ->explode('-')
            ->map(function (string $number): string {
                if (is_numeric($number)) {
                    /**
                     * @var string $number
                     */
                    $number = Number::format(
                        number: (int) $number,
                        precision: 0,
                    );
                }

                return $number;
            })->implode(' - ');

        return str($label)
            ->whenContains(
                'plus',
                fn (Stringable $value): Stringable => $value->replace(' - plus', '+')
            )
            ->append(' sq ft')
            ->toString();
    }

    /**
     * Get the range of areas for the given area range.
     *
     * @return array<int, int<min, -1>|int<1, max>>
     */
    public function toArray(): array
    {
        /**
         * @var array<int, int<min, -1>|int<1, max>>
         */
        return str($this->value)
            ->explode('-')
            ->reject(fn (string $value): bool => $value === 'plus')
            ->map(fn (string $value): int => (int) $value)
            ->toArray();
    }

    /**
     * Get the range of areas for the given area range.
     *
     * @return Collection<int, int<min, -1>|int<1, max>>
     */
    public function collect(): Collection
    {
        return collect($this->toArray());
    }
}
