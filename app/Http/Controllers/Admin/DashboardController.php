<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\GetAnnualMessages;
use App\Actions\GetWeeklyMessages;
use App\Enums\PageEnum;
use Inertia\Inertia;
use Inertia\Response;

final class DashboardController
{
    public function __invoke(
        GetAnnualMessages $getAnnualMessages,
        GetWeeklyMessages $getWeeklyMessages,
    ): Response {
        return Inertia::render(PageEnum::ADMIN_DASHBOARD->value, [
            'annual_messages' => fn (): array => $getAnnualMessages->execute(),
            'weekly_messages' => fn (): array => $getWeeklyMessages->execute(),
        ]);
    }
}
