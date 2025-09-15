<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;

final class AdminController
{
    public function __invoke(): RedirectResponse
    {
        return redirect()->intended(route('admin.dashboard'));
    }
}
