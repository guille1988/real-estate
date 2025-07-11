<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PageEnum;
use Inertia\Inertia;
use Inertia\Response;

final class ContactController
{
    public function __invoke(): Response
    {
        return Inertia::render(PageEnum::CONTACT->value);
    }
}
