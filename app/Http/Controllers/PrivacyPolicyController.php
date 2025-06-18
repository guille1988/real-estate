<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class PrivacyPolicyController
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render('PrivacyPolicy', [
            'url' => $request->session()->previousUrl() ?? '/',
            'fragment' => $request->query('fragment', ''),
        ]);
    }
}
