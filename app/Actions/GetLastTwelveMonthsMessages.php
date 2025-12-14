<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Inquiry;
use App\Models\PropertyMessage;
use Illuminate\Support\Carbon;

final readonly class GetLastTwelveMonthsMessages
{
    public function execute(): array
    {
        $now = now()->toImmutable();

        $baseMonths = collect(range(0, 11))
            ->mapWithKeys(function (int $month) use ($now): array {
                $yearMonth = $now->subMonths(11 - $month)->format('Y-m');

                return [$yearMonth => 0];
            });

        $propertyMessageLastTwelveMonths = PropertyMessage::query()
            ->lastTwelveMonths($now)
            ->pluck('total', 'period')
            ->mapWithKeys(function (int $count, string $period): array {
                $yearMonth = Carbon::parse($period)->format('Y-m');

                return [$yearMonth => $count];
            });

        $inquiryLastTwelveMonths = Inquiry::query()
            ->lastTwelveMonths($now)
            ->pluck('total', 'period')
            ->mapWithKeys(function (int $count, string $period): array {
                $yearMonth = Carbon::parse($period)->format('Y-m');

                return [$yearMonth => $count];
            });

        $lastTwelveMonthsTotal = $baseMonths->map(function (int $zero, string $yearMonth) use ($propertyMessageLastTwelveMonths, $inquiryLastTwelveMonths): int {
            return $propertyMessageLastTwelveMonths->get($yearMonth, 0) + $inquiryLastTwelveMonths->get($yearMonth, 0);
        });

        $labels = $lastTwelveMonthsTotal->keys()
            ->map(function (string $yearMonth): string {
                return Carbon::createFromFormat('Y-m', $yearMonth)->format("M 'y");
            });

        return [
            'labels' => $labels,
            'counts' => $lastTwelveMonthsTotal->values(),
        ];
    }
}
