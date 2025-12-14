<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Inquiry;
use App\Models\PropertyMessage;
use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

final readonly class GetLastSevenDaysMessages
{
    public function execute(): array
    {
        /**
         * @var CarbonImmutable $now
         */
        $now = now();

        $baseDays = collect(range(0, 6))
            ->mapWithKeys(function (int $day) use ($now): array {
                $yearMonthDay = $now->subDays(6 - $day)->format('Y-m-d');

                return [$yearMonthDay => 0];
            });

        $propertyMessageWeekly = PropertyMessage::query()
            ->lastSevenDays($now)
            ->pluck('total', 'period')
            ->mapWithKeys(function ($count, string $period): array {
                $yearMonthDay = Carbon::createFromFormat('Y-m-d', $period)->format('Y-m-d');

                return [$yearMonthDay => (int) $count];
            });

        $inquiryWeekly = Inquiry::query()
            ->lastSevenDays($now)
            ->pluck('total', 'period')
            ->mapWithKeys(function ($count, string $period): array {
                $yearMonthDay = Carbon::createFromFormat('Y-m-d', $period)->format('Y-m-d');

                return [$yearMonthDay => (int) $count];
            });

        $lastSevenDaysTotal = $baseDays->map(function (int $zero, string $yearMonthDay) use ($propertyMessageWeekly, $inquiryWeekly): int {
            return $propertyMessageWeekly->get($yearMonthDay, 0) + $inquiryWeekly->get($yearMonthDay, 0);
        });

        $labels = $lastSevenDaysTotal->keys()
            ->map(function (string $ymd): string {
                return Carbon::createFromFormat('Y-m-d', $ymd)->format('D d');
            });

        return [
            'labels' => $labels,
            'counts' => $lastSevenDaysTotal->values(),
        ];
    }
}
