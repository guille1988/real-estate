<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Inquiry;
use App\Models\PropertyMessage;
use Illuminate\Support\Carbon;

final readonly class GetAnnualMessages
{
    public function execute(): array
    {
        $propertyMessageAnnual = PropertyMessage::query()
            ->annual()
            ->pluck('total', 'period')
            ->mapWithKeys(function (int $count, string $period): array {
                $key = Carbon::parse($period)->format('M');

                return [$key => $count];
            });

        $inquiryAnnual = Inquiry::query()
            ->annual()
            ->pluck('total', 'period')
            ->mapWithKeys(function (int $count, string $period): array {
                $key = Carbon::parse($period)->format('M');

                return [$key => $count];
            });

        $annualCount = $propertyMessageAnnual->map(
            fn (int $count, string $key): int => $count + $inquiryAnnual->get($key, 0)
        );

        return [
            'months' => $annualCount->keys(),
            'counts' => $annualCount->values(),
        ];
    }
}
