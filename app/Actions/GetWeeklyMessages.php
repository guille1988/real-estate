<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Inquiry;
use App\Models\PropertyMessage;
use Illuminate\Support\Carbon;

final readonly class GetWeeklyMessages
{
    public function execute(): array
    {
        $propertyMessageWeekly = PropertyMessage::query()
            ->weekly()
            ->pluck('total', 'period')
            ->mapWithKeys(function (int $count, string $period): array {
                $key = Carbon::parse($period)->format('D');

                return [$key => $count];
            });

        $inquiryWeekly = Inquiry::query()
            ->weekly()
            ->pluck('total', 'period')
            ->mapWithKeys(function (int $count, string $period): array {
                $key = Carbon::parse($period)->format('D');

                return [$key => $count];
            });

        $weeklyCount = $propertyMessageWeekly->map(
            fn (int $count, string $key): int => $count + $inquiryWeekly->get($key, 0)
        );

        return [
            'labels' => $weeklyCount->keys(),
            'counts' => $weeklyCount->values(),
        ];
    }
}
