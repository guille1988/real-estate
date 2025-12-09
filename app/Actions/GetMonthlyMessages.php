<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Inquiry;
use App\Models\PropertyMessage;
use Illuminate\Support\Collection;

final readonly class GetMonthlyMessages
{
    public function execute(): Collection
    {
        $propertyMessageYearly = PropertyMessage::query()
            ->lastTwelveMonths()
            ->pluck('total', 'month');

        $inquiryYearly = Inquiry::query()
            ->lastTwelveMonths()
            ->pluck('total', 'month');

        $lastTwelveMonths = collect(range(1, 12))
            ->slice($month = now()->month)
            ->merge(range(1, $month))
            ->values();

        return $lastTwelveMonths
            ->mapWithKeys(fn (int $month): array => [
                $month => $propertyMessageYearly->get($month, 0) + $inquiryYearly->get($month, 0),
            ]);
    }
}
