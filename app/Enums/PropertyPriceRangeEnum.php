<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

enum PropertyPriceRangeEnum: string
{
    case BETWEEN_100_000_AND_300_000 = '100000-300000';
    case BETWEEN_300_000_AND_500_000 = '300000-500000';
    case BETWEEN_500_000_AND_800_000 = '500000-800000';
    case BETWEEN_800_000_AND_1_200_000 = '800000-1200000';
    case MORE_THAN_1_200_000 = '1200000-plus';

    /*
     * Returns the label version of the price range value.
     */
    private function getLabel(): string
    {
        return match ($this) {
            self::BETWEEN_100_000_AND_300_000 => '$100,000 - $300,000',
            self::BETWEEN_300_000_AND_500_000 => '$300,000 - $500,000',
            self::BETWEEN_500_000_AND_800_000 => '$500,000 - $800,000',
            self::BETWEEN_800_000_AND_1_200_000 => '$800,000 - $1,200,000',
            self::MORE_THAN_1_200_000 => '$1,200,000+',
        };
    }

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

    /**
     * Get the range of prices for the given price range.
     *
     * @return array<int, int<min, -1>|int<1, max>>
     */
    public function toArray(): array
    {
        return match ($this) {
            self::BETWEEN_100_000_AND_300_000 => [100000, 300000],
            self::BETWEEN_300_000_AND_500_000 => [300000, 500000],
            self::BETWEEN_500_000_AND_800_000 => [500000, 800000],
            self::BETWEEN_800_000_AND_1_200_000 => [800000, 1200000],
            self::MORE_THAN_1_200_000 => [1200000],
        };
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
