<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\PageEnum;
use Inertia\Inertia;
use Inertia\Response;

final class PropertyController
{
    public function index(): Response
    {
        return Inertia::render(PageEnum::ADMIN_PROPERTIES->value);
    }

    //    public function create(): Response
    //    {
    //        return Inertia::render(PageEnum::ADMIN_PROPERTIES->value);
    //    }
    //
    //    public function store(Request $request): RedirectResponse
    //    {
    //        return back();
    //    }
    //
    //    public function show(Property $property): Response
    //    {
    //        return Inertia::render(PageEnum::ADMIN_PROPERTIES->value);
    //    }
    //
    //    public function edit(Property $property): Response
    //    {
    //        return Inertia::render(PageEnum::ADMIN_PROPERTIES->value);
    //    }
    //
    //    public function update(Request $request, Property $property): RedirectResponse
    //    {
    //        return back();
    //    }
    //
    //    public function destroy(Property $property): RedirectResponse
    //    {
    //        return back();
    //    }
}
