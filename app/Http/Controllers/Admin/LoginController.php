<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Data\LoginData;
use App\Enums\PageEnum;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final class LoginController
{
    public function create(): Response
    {
        return Inertia::render(PageEnum::ADMIN_LOGIN->value);
    }

    public function store(LoginData $data): RedirectResponse
    {
        if (! auth()->attempt($data->toArray())) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        request()->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(): RedirectResponse
    {
        auth()->guard('web')->logout();

        ($request = request())->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('admin.login.create');
    }
}
