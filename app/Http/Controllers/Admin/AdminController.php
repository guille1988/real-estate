<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\PageEnum;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final class AdminController
{
    public function __invoke(): RedirectResponse
    {
        return redirect()->intended(route('admin.dashboard'));
    }
}
