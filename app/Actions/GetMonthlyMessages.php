<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Inquiry;
use App\Models\PropertyMessage;
use Illuminate\Support\Carbon;

final readonly class GetMonthlyMessages
{
    public function execute(): array
    {
        $propertyMessageYearly = PropertyMessage::query()
            ->lastTwelveMonths()
            ->pluck('total', 'period')
            ->mapWithKeys(function (int $count, string $period): array {
                $key = Carbon::parse($period)->format('M');

                return [$key => $count];
            });

        $inquiryYearly = Inquiry::query()
            ->lastTwelveMonths()
            ->pluck('total', 'period')
            ->mapWithKeys(function (int $count, string $period): array {
                $key = Carbon::parse($period)->format('M');

                return [$key => $count];
            });

        $yearlyCount = $propertyMessageYearly->map(
            fn (int $count, string $key): int => $count + $inquiryYearly->get($key, 0)
        );

        return [
            'months' => $yearlyCount->keys(),
            'counts' => $yearlyCount->values(),
        ];
    }
}
