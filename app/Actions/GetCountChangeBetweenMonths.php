<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Number;

final readonly class GetCountChangeBetweenMonths
{
    public function execute(int $thisMonthCount, int $lastMonthCount): string
    {
        if ($lastMonthCount === 0) {
            $rawChange = $thisMonthCount === 0 ? 0 : 100;
        } else {
            $rawChange = (($thisMonthCount - $lastMonthCount) / $lastMonthCount) * 100;
        }

        /**
         * @var string $change
         */
        $change = Number::percentage($rawChange);

        return $change;
    }
}
