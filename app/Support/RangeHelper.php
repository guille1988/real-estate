<?php

declare(strict_types=1);

namespace App\Support;

final class RangeHelper
{
    /**
     * @return array<int, array{label: string, value: int}>
     *
     * Generate a range of label value numbers.
     */
    public function __invoke(int $max): array
    {
        return array_map(
            fn (int $number): array => [
                'label' => (string) $number,
                'value' => $number,
            ], range(1, $max));
    }
}
