<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

final class PropertyController
{
    public function index(): Response
    {
        return Inertia::render('Properties');
    }

    public function show($id): Response
    {
        return Inertia::render('PropertyDetails', compact('id'));
    }
}
