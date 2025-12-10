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

        return collect();
    }
}
