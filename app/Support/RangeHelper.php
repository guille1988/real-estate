<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Number;

final class RangeHelper
{
    /**
     * @return array<int, array{label: string, value: int}>
     *
     * Generate a range of label value numbers.
     */
    public function __invoke(int $max): array
    {
        return array_map(function (int $number): array {
            /**
             * @var string $label
             */
            $label = Number::spell($number);

            return [
                'label' => ucfirst($label),
                'value' => $number,
            ];
        }, range(1, $max));
    }
}
