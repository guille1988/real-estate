<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\GetLastSevenDaysMessages;
use App\Actions\GetLastTwelveMonthsMessages;
use App\Enums\PageEnum;
use Inertia\Inertia;
use Inertia\Response;

final class DashboardController
{
    public function __invoke(
        GetLastTwelveMonthsMessages $getLastTwelveMonthsMessages,
        GetLastSevenDaysMessages $getLastSevenDaysMessages,
    ): Response {
        return Inertia::render(PageEnum::ADMIN_DASHBOARD->value, [
            'last_twelve_months_messages' => fn (): array => $getLastTwelveMonthsMessages->execute(),
            'last_seven_days_messages' => fn (): array => $getLastSevenDaysMessages->execute(),
        ]);
    }
}
