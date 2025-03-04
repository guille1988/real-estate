<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Response;
use Inertia\ResponseFactory;

final class PropertyController
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia('Properties');
    }
}
