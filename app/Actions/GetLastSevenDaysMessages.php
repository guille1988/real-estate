<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Inquiry;
use App\Models\PropertyMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final readonly class GetLastSevenDaysMessages
{
    /**
     * @return array<string, array<int|string>>
     */
    public function execute(): array
    {
        $now = now()->toImmutable();

        $baseDays = collect(range(0, 6))
            ->mapWithKeys(function (int $day) use ($now): array {
                $yearMonthDay = $now->subDays(6 - $day)->format('Y-m-d');

                return [$yearMonthDay => 0];
            });

        /** @var Collection<string,int> $propertyMessages */
        $propertyMessages = PropertyMessage::query()
            ->lastSevenDays($now)
            ->pluck('total', 'period');

        $propertyMessageWeekly = $propertyMessages
            ->mapWithKeys(fn (int $count, string $period): array => [$period => $count]);

        /** @var Collection<string,int> $inquiries */
        $inquiries = Inquiry::query()
            ->lastSevenDays($now)
            ->pluck('total', 'period');

        $inquiryWeekly = $inquiries->mapWithKeys(
            fn (int $count, string $period): array => [$period => $count]
        );

        /** @var Collection<string,int> $lastSevenDaysTotal */
        $lastSevenDaysTotal = $baseDays->map(function (int $zero, string $yearMonthDay) use ($propertyMessageWeekly, $inquiryWeekly): int {
            return $propertyMessageWeekly->get($yearMonthDay, 0) + $inquiryWeekly->get($yearMonthDay, 0);
        });

        /** @var Collection<int,string> $keys */
        $keys = $lastSevenDaysTotal->keys();

        /** @var Collection<int, string> $rawLabels */
        $rawLabels = $keys->map(function (string $yearMonthDay): string {
            /** @var Carbon $date */
            $date = Carbon::createFromFormat('Y-m-d', $yearMonthDay);

            return $date->format('D d');
        })->values();

        /** @var Collection<int,int> $rawCounts */
        $rawCounts = $lastSevenDaysTotal->values();

        /** @var array<int, string> $labels */
        $labels = $rawLabels->toArray();

        /** @var array<int,int> $counts */
        $counts = $rawCounts->toArray();

        return compact(['labels', 'counts']);
    }
}
