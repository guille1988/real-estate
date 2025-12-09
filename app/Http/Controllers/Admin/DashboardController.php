<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\GetMonthlyMessages;
use App\Enums\PageEnum;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

final class DashboardController
{
    public function __invoke(GetMonthlyMessages $getMonthlyMessages): Response
    {
        return Inertia::render(PageEnum::ADMIN_DASHBOARD->value, [
            'monthly_messages' => fn (): Collection => $getMonthlyMessages->execute(),
        ]);
    }
}
