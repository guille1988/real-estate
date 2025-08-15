<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Collection;

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
        return match ($this) {
            self::BETWEEN_500_AND_1000 => '500 - 1,000 sq ft',
            self::BETWEEN_1_000_AND_1_500 => '1,000 - 1,500 sq ft',
            self::BETWEEN_1_500_AND_2_000 => '1,500 - 2,000 sq ft',
            self::BETWEEN_2_000_AND_3_000 => '2,000 - 3,000 sq ft',
            self::MORE_THAN_3_000 => '3,000+ sq ft',
        };
    }

    /**
     * Get the range of areas for the given area range.
     *
     * @return array<int, int<min, -1>|int<1, max>>
     */
    public function toArray(): array
    {
        return match ($this) {
            self::BETWEEN_500_AND_1000 => [500, 1000],
            self::BETWEEN_1_000_AND_1_500 => [1000, 1500],
            self::BETWEEN_1_500_AND_2_000 => [1500, 2000],
            self::BETWEEN_2_000_AND_3_000 => [2000, 3000],
            self::MORE_THAN_3_000 => [3000],
        };
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
