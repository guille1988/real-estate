<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Inquiry;
use App\Models\PropertyMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final readonly class GetLastTwelveMonthsMessages
{
    /**
     * @return array<string, array<int|string>>
     */
    public function execute(): array
    {
        $now = now()->toImmutable();

        $baseMonths = collect(range(0, 11))
            ->mapWithKeys(function (int $month) use ($now): array {
                $yearMonth = $now->subMonths(11 - $month)->format('Y-m');

                return [$yearMonth => 0];
            });

        /** @var Collection<string,int> $propertyMessages */
        $propertyMessages = PropertyMessage::query()
            ->lastTwelveMonths($now)
            ->pluck('total', 'period');

        $propertyMessageLastTwelveMonths = $propertyMessages->mapWithKeys(
            fn (int $count, string $period): array => [$period => $count]
        );

        /** @var Collection<string,int> $inquiries */
        $inquiries = Inquiry::query()
            ->lastTwelveMonths($now)
            ->pluck('total', 'period');

        $inquiryLastTwelveMonths = $inquiries->mapWithKeys(fn (int $count, string $period): array => [$period => $count]);

        /** @var Collection<string,int> $lastTwelveMonthsTotal */
        $lastTwelveMonthsTotal = $baseMonths->map(function (int $zero, string $yearMonth) use ($propertyMessageLastTwelveMonths, $inquiryLastTwelveMonths): int {
            return $propertyMessageLastTwelveMonths->get($yearMonth, 0) + $inquiryLastTwelveMonths->get($yearMonth, 0);
        });

        /** @var Collection<int,string> $keys */
        $keys = $lastTwelveMonthsTotal->keys();

        /** @var Collection<int, string> $rawLabels */
        $rawLabels = $keys->map(function (string $yearMonth): string {
            /** @var Carbon $date */
            $date = Carbon::createFromFormat('Y-m', $yearMonth);

            return $date->format("M 'y");
        })->values();

        /** @var Collection<int,int> $rawCounts */
        $rawCounts = $lastTwelveMonthsTotal->values();

        /** @var array<int, string> $labels */
        $labels = $rawLabels->toArray();

        /** @var array<int,int> $counts */
        $counts = $rawCounts->toArray();

        return compact(['labels', 'counts']);
    }
}
