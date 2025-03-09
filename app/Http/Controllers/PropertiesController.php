<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Response;
use Inertia\ResponseFactory;

final class PropertiesController
{
    public function index(): Response|ResponseFactory
    {
        return inertia('Properties');
    }

    public function show(int $id): Response|ResponseFactory
    {
        return inertia('PropertyDetails', compact('id'));
    }
}
