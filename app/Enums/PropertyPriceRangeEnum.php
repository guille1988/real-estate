<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Stringable;

enum PropertyPriceRangeEnum: string
{
    case BETWEEN_100_000_AND_300_000 = '100000-300000';
    case BETWEEN_300_000_AND_500_000 = '300000-500000';
    case BETWEEN_500_000_AND_800_000 = '500000-800000';
    case BETWEEN_800_000_AND_1_200_000 = '800000-1200000';
    case MORE_THAN_1_200_000 = '1200000-plus';

    /**
     * @return Collection<int, array{label: string, value: string}>
     *
     * Returns the label and value response version of all price ranges.
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
     * Returns the label version of the price range value.
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
                    $number = Number::currency(
                        number: (int) $number,
                        in: 'USD',
                        precision: 0,
                    );
                }

                return $number;
            })->implode(' - ');

        return str($label)
            ->whenContains(
                'plus',
                fn (Stringable $value): Stringable => $value->replace(' - plus', '+')
            )->toString();
    }

    /**
     * Get the range of prices for the given price range.
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
     * Get the range of prices for the given price range.
     *
     * @return Collection<int, int<min, -1>|int<1, max>>
     */
    public function collect(): Collection
    {
        return collect($this->toArray());
    }
}
